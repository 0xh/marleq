<?php

namespace App\Http\Controllers;

use App\Events\NewMessageNotification;
use App\Inbox;
use App\Message;
use App\Notifications\NewInboxMessage;
use App\User;
use Auth;
use Illuminate\Http\Request;

class MessageController extends Controller
{
    public function __construct() {
        $this->middleware('auth');
    }

    /**
     * Display a chat screen with messages from a user.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($userAlias)
    {
        $user = Auth::user();
        $userTo = User::where('alias', $userAlias)->first();
        $userToId = $userTo->id;
        $userId = $user->id;
        $userChannelId = $user->alias;

        $chat = Inbox::where('user_from_id', $userId)->where('user_to_id', $userToId)->first();

        if ($chat) {
            if ($chat->new_message == 1) {
                $chat->update(['new_message' => 0]);
            }
        } else {
            Inbox::create(['user_from_id' => $userId, 'user_to_id' => $userToId]);
            Inbox::create(['user_from_id' => $userToId, 'user_to_id' => $userId]);
            $userTo->notify(new NewInboxMessage($user, $userTo));
        }

        $messages = Message::where('user_from_id', '=', $userId)
            ->where('user_to_id', '=', $userToId)
            ->orWhere('user_from_id', '=', $userToId)->where('user_to_id', '=', $userId)
            ->get();

        return view('chat.broadcast', compact('userChannelId', 'user', 'userTo', 'messages'));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function inbox()
    {
        $user = Auth::user();
        $messages = Inbox::where('user_from_id', $user->id)
            ->orderBy('updated_at', 'DESC')
            ->get();

        return view('chat.inbox', compact('messages'));
    }

    public function send(Request $request)
    {
        $message = new Message;
        $message->setAttribute('user_from_id', Auth::user()->id);
        $message->setAttribute('user_to_id', $request->userToId);
        $message->setAttribute('message', $request->message);
        $message->save();

        $inboxMessage = Inbox::where('user_from_id', $request->userToId)->where('user_to_id', Auth::user()->id)->first();
        $inboxMessage->new_message = 1;
        $inboxMessage->updated_at = now();
        $inboxMessage->save();

        $userChannelId = $request->userAlias;

        event(new NewMessageNotification($message, $userChannelId));

        return [
            'message' => $message->message,
            'created_at' => $message->created_at->format('Y-m-d H:i:s'),
            'user_from_id' => $message->user_from_id,
            'user_to_id' => $message->user_to_id
        ];
    }

    public function messageRead(Request $request) {
        $inboxMessage = Inbox::where('user_from_id', $request->user_to_id)->where('user_to_id', $request->user_from_id)->first();
        $inboxMessage->new_message = 0;
        $inboxMessage->save();

        return response()->json([
            'message' => 'Message has been read!',
        ], 200);
    }
}
