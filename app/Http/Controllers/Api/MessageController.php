<?php

namespace App\Http\Controllers\Api;

use App\Room;
use App\User;
use App\Message;
use Carbon\Carbon;
use App\Participant;
use Illuminate\Http\Request;
use App\Events\PrivateMessage;
use Illuminate\Support\Facades\DB;
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
        $user = User::findOrFail($user_id);

        $rooms = Participant::select('room_id')
                            ->where('user_id', Auth::id())
                            ->orWhere('user_id', $user_id)
                            ->distinct()
                            ->get()->toArray();
        
        foreach($rooms as $key => $value) {
            $matchs = Participant::where('room_id', $rooms[$key]['room_id'])
                                    ->where('user_id', $user_id)
                                    ->first();
            $matchs !== null ? $match = $matchs : $match = null;
        }

        $room = Room::firstOrCreate([ 'id'   => empty($match) ? null : $match->room_id ],
                                    [ 'name' => auth()->user()->name . ' - ' . $user->name ]);

        if(empty($matchs)) {
            $participants = [ Auth::id(), $user_id ];
                
            foreach($participants as $participant) { 
                $room->participant()->firstOrCreate([
                    'user_id' => $participant,
                    'room_id' => $room->id,
                ]);
            }
        }

        $this->getMessage($room->id);
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

    public function getMessage($room_id)
    {
        $message = new Message;
        $message->where(function($query) use ($room_id) {
            $query->where('room_id', $room_id)
                    ->where('from_id', '!=', Auth::id());
        })->update(['status' => 2]);
        $message->refresh();

        $messages = $message->where('room_id', $room_id)->get();

        return response()->json(MessageResource::collection($messages));
    }

    public function sendPrivateMessage(Request $request, $room_id)
    {

        $user = User::findOrFail(Auth::id());

        $message = $user->messages()->create([
            'room_id' => $room_id,
            'from_id' => $user->id,
            'message' => $request->message,
        ]);

        broadcast(new PrivateMessage($message->load('from')))->toOthers();

        $message = new MessageResource($message->load('from'));

        return $this->sendResponse('succes', 'Message sent successfully', $message, 200);
    }

    public function deleteMessage($message_id) 
    {
        $message = Message::findOrFail($message_id);

        

        return response()->json($message);
    }
}
