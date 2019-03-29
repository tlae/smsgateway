<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Message;
use App\Chat;
use App\Msisdn;
use App\Http\Requests\ChatRequest;

class ChatsController extends Controller
{
    
    public function __construct() {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
         $chats = Chat::with('user')->latest()->paginate(5);

        return view('chats.index', compact('chats'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Message $id)
    {
        $chat = new Chat();
        return view('chats.create', compact('chat', 'id'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Message $message, ChatRequest $request)
    {
        
         $chat = $message->chat()->create( $request->validate(['title' => 'required', 'summary' =>'required' ])  + 
                ['user_id' => \Auth::id()] + ['message_id' => $message->id]);
         $count = Message::where('msisdn', '=', $message->msisdn)
                            ->where('id', '>=', $message->id)->update(['chat_id' => $chat->id, 'corruption_related_id' => 1]);
         $message->phone->chats_count = $message->phone->chats_count + 1;
         $message->phone->open_chat_id = $chat->id;
         $message->phone->corruption_related_count = $count;
         $message->phone->save();
         


         return redirect()->route('chats.show', $chat->slug)->with('success', "Chat created successfully");
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Chat $chat)
    {
        return view('chats.show', compact('chat'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Chat $chat)
    {
        return view('chats.edit', compact('chat'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $chat)
    {
       $chat->update($request->only('title', 'summary'));
        return redirect()->route('chats.show', $chat->slug)->with('success', "Chat updated");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
