<?php

namespace App\Http\Controllers;

use App\Models\Channel;
use App\Models\Message;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ChatController extends Controller
{
    public function loadDashboard(){
        $all_users = User::where('id', '!=', Auth::id())->get();
        return view('dashboard', compact('all_users'));
    }

    public function checkChannel(Request $request){
        $recipientId = $request->recipientId;
        $loggedInUserId = Auth::id();

        $channel = Channel::where(function ($query) use ($recipientId, $loggedInUserId){
            $query->where('user1_id', $loggedInUserId)
                ->where('user2_id', $recipientId);
        })->orWhere(function ($query) use ($recipientId, $loggedInUserId){
            $query->where('user1_id', $recipientId)
                ->where('user2_id', $loggedInUserId);
        })->first();

        if($channel){
            return response()->json([
                'channelExists' => true,
                'channelName' => $channel->name,
                'channelId' => $channel->id,
            ]);
        }else{
            return response()->json([
                'channelExists' => false,
            ]);
        }
    }

    public function createChannel(Request $request){
        $recipientId = $request->recipientId;
        $loggedInUserId = Auth::id();

        try {
            $channelName = 'chat-' . min($recipientId, $loggedInUserId) . '-' . max($recipientId, $loggedInUserId);

               $channel = Channel::create([
                'user1_id' => $loggedInUserId,
                'user2_id' => $recipientId,
                'name' => $channelName,
            ]);

            return response()->json([
                'success' => true,
                'channelName' => $channelName,
                'channelId' => $channel->id,

            ]);
        }catch (\Exception $e){
            return response()->json([
                'success' => false,
                'error' => $e->getMessage(),
            ]);
        }
    }

    public function storeMessage(Request $request){
      Message::create(
        $request->all()
      );
        return response()->json([
            'success' => true,
            'message' => $request->all(),
        ],201);
    }

    public function getMessages(Request $request){
        $messages = Message::where('channel_id', $request->channelId)->get();
        return response()->json([
            'success' => true,
            'messages'=> $messages,
        ]);
    }
}
