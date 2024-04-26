<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Chatbot;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ChatController extends Controller
{
    //
    public function fetchChats()
    {
        $user_id = Auth::user()->id;
        $chats = Chatbot::where('user_id', $user_id)->orWhere('to_user', $user_id)->get();

        return response()->json($chats);
    }

    public function fetchAdminChats(Request $request)
    {
        $user_id = $request->input('user_id');
        $chats = Chatbot::where('user_id', $user_id)->orWhere('to_user', $user_id)->get();

        return response()->json($chats);

    }

    public function updateStatus(Request $request)
    {
        $userId = $request->input('user_id');
        
        // $chats = Chatbot::where('user_id', $user_id)->orWhere('to_user', $user_id)->get();
        Chatbot::where('user_id', $userId)
        ->orWhere('to_user', $userId)
        ->update(['status' => 1]);

        
        return response()->json(['message' => 'Status updated successfully']);
    }

        public function fetchUsers(Request $request)
        {
            // Fetch users data
            $chats = Chatbot::orderBy('id', 'desc')->get();
            $users_id = [];
            $users = [];

            foreach($chats as $chat){
                $users_id[] = $chat->user_id;
                $users_id[] = $chat->to_user;
            }

            $users_unique_id = array_unique($users_id);

            foreach($users_unique_id as $user_unique_id){
                $user = User::role('user')->where('id', $user_unique_id)->first();
                $unread_chat_count = Chatbot::where('user_id',$user_unique_id)->where('status', '0')->count();  
                
                if($user !== null)
                {
                    $user_with_unread_count = [
                        'full_user' => $user,
                        'unread_chat_count' => $unread_chat_count,
                    ];
                    // Add the associative array to the $users array
                    $users[] = $user_with_unread_count;
                }
            }

            // Return users data as JSON response
            return response()->json($users);
        }

    public function index()
    {
        // $users = User::role('user')->get();
        $chats = Chatbot::orderBy('id', 'desc')->get();
        $users_id = [];
        $users = [];

        foreach($chats as $chat){
            $users_id[] = $chat->user_id;
            $users_id[] = $chat->to_user;
        }

        $users_unique_id = array_unique($users_id);

        foreach($users_unique_id as $user_unique_id){
            $user = User::role('user')->where('id', $user_unique_id)->first();
            $unread_chat_count = Chatbot::where('user_id',$user_unique_id)->where('status', '0')->count();  
            
            if($user !== null)
            {
                $user_with_unread_count = [
                    'full_user' => $user,
                    'unread_chat_count' => $unread_chat_count,
                ];
                // Add the associative array to the $users array
                $users[] = $user_with_unread_count;
            }
        }
        // dd($users);

        return view('backend.chat.index', ['users' => $users]);
    }

    public function store(Request $request)
    {

        $messageContent = $request->input('message');
        $toUserId = $request->input('id');

        $message = new Chatbot();
        $message->massage = $messageContent;
        $message->status = '0';
        $message->user_id = Auth::user()->id;
        $message->to_user = $toUserId;
        $message->save();

        return response()->json(['success' => true]);
    }
}
