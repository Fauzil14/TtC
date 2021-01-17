<?php

namespace App\Http\Controllers\Api;

use App\Message;
use App\Participant;
use App\Room;
use App\User;
use Illuminate\Http\Request;
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

        $participant = Participant::firstWhere(['user_id' => Auth::id(), 'user_id' => $user_id]);

        $room = Room::firstOrCreate([ 'id' => empty($participant->room_id) ? null : $participant->room_id ],
                                    [ 'name' => auth()->user()->name . ' - ' . $user->name ]);
        
        $inputs = [
                    [ 'user_id' => Auth::id(), 'room_id' => $room->id ],
                    [ 'user_id' => $user_id, 'room_id' => $room->id ]
                 ];

        foreach($inputs as $input) {
            $room->participant()->firstOrCreate($input);
        }
        return response()->json($room->load('participant'));
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

        $messages = $message->where('room_id', $room_id)->with('from:id,name')->get();

        return response()->json(MessageResource::collection($messages));
    }

    public function sendMessage()
    {

    }
}
