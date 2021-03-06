<?php

namespace App\Http\Controllers\Api;

use App\Room;
use App\User;
use App\Message;
use Pusher\Pusher;
use Illuminate\Http\Request;
use App\Events\PrivateMessage;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;
use App\Http\Resources\RoomResource;
use Illuminate\Support\Facades\Auth;
use App\Http\Resources\MessageResource;

class MessageController extends Controller
{   
        // message status 
        //   1 => 'unread', 
        //   2 => 'read',
        //   3 => 'deleted_for_auth_user_only'
        //   4 => 'deleted_for_all', 

    public function makeRoom($user_id)
    {   

        $user = User::find($user_id);

        $room = Room::whereHas('participant', function($q) {
                        $q->where('user_id', Auth::id());
                    })->with(['participant' => function($query) use ($user_id) {
                        $query->where('user_id', $user_id);
                    }])->get('id', 'participant');


        if(is_null($room->first())) {
            $room_id = null;
        } else {
            $room = $room->filter(function($item) {
                if(!is_null($item->participant->first())) {
                    return $item;
                }
            });
            
            if(is_null($room->first())) {
                $room_id = null;
            } else {
                $room_id = $room->first()->id;
            }
        }

        $room = Room::firstOrCreate([ 'id'   => $room_id ],
                                    [ 'name' => auth()->user()->name . ' - ' . $user->name ]);

        if(is_null($room_id)) {
            $participants = [ Auth::id(), $user_id ];
                
            foreach($participants as $participant) { 
                $room->participant()->create([
                    'user_id' => $participant,
                    'room_id' => $room->id,
                ]);
            }
        }

        return $room->id;
    }

    public function showContact()
    {
        $room = Room::whereHas('participant', function($q) {
            $q->where('user_id', Auth::id());
        })->with(['participant' => function($q) {
            $q->where('user_id', '!=', Auth::id());
        }])->get();

        return response()->json(RoomResource::collection($room));
    }

    public function fetchMessage(Request $request)
    {

        $request->validate([
            'room_id' => [ 'exists:App\Room,id' ],
            'user_id' => [ Rule::requiredIf(empty($request->room_id)), 'user_role:roles,nasabah,pengurus-satu,bendahara' ],
        ]);

        if (empty($request->room_id)) { 
            if($request->user_id == Auth::id()) {
                return $this->sendResponse('failed', "You can't chat with yourself, get some friends !", null, 400);
            }
            $room_id = $this->makeRoom($request->user_id);
        } else {
            $room_id = $request->room_id;
        }

        $message = new Message;
        $message->where(function($query) use ($room_id) {
            $query->where('room_id', $room_id)
                  ->where('from_id', '!=', Auth::id())
                  ->where('status', 1);
        })->update(['status' => 2]);
        $message->refresh();

        $messages = $message->where('room_id', $room_id)
                            ->where(function($query) {
                                $query->where('from_id', '!=', Auth::id())
                                        ->orWhere('status', '!=', 3);
                            })->get();
        
        $messages = MessageResource::collection($messages);
     
        return response()->json([
            'status'  => 'success',
            'room_id'  => $room_id,
            'messages' => $messages,
        ], 200);
    }

    public function sendPrivateMessage(Request $request)
    {
        $request->validate([
            'room_id' => 'required|exists:rooms,id',
        ]);

        $user = User::findOrFail(Auth::id());

        $message = $user->messages()->create([
            'room_id' => $request->room_id,
            'from_id' => $user->id,
            'message' => $request->message,
        ]);

        $message = new MessageResource($message->load('from'));
        
        $pusher = new Pusher(
            env('PUSHER_APP_KEY'),
            env('PUSHER_APP_SECRET'),
            env('PUSHER_APP_ID'),
            [
                'cluster' => env('PUSHER_APP_CLUSTER'),
                'useTLS' => true,
            ],
        );

        $pusher->trigger('my-channel', 'my-event', $message);

        return $this->sendResponse('succes', 'Message sent successfully', $message, 200);
    }

    public function deleteMessage($message_id) 
    {
        $message = Message::where(function($query) {
            $query->where('status', 1)->orWhere('status', 2);
        })->findOrFail($message_id);

        $message->deletedMessage()->create([
                                            'message_id'      => $message->id,
                                            'deleted_message' => $message->message,
                                            'deleted_by_id'   => Auth::id(),
                                           ]);
                                           
        if ($message->status == 1 && $message->from_id == Auth::id()) {
            $message->message = "Pesan ini telah di hapus oleh " . Auth::user()->name;
            $message->status = 4;
        } elseif ($message->status == 2 && $message->from_id == Auth::id()) {
            $message->status = 3;
        }
        $message->deleted_at = now();
        $message->update();

        return $this->sendResponse('succes', 'Message deleted successfully', $message, 200);
    }

    public function updateMessage(Request $request) 
    {
        $message = Message::where(function($query) {
                                $query->where('status', 1)->orWhere('status', 2);
                            })->findOrFail($request->message_id);

        $message->update(['message' => $request->message]);

        return $this->sendResponse('succes', 'Message updated successfully', $message, 200);
    }
}
