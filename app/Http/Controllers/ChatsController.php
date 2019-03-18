<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Message;
use App\Chat;
use App\Http\Requests\ChatRequest;

class ChatsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        
         $message->chat()->create( $request->validate(['title' => 'required', 'summary' =>'required' ]) + 
                    ['user_id' => \Auth::id()]+ ['message_id' => $message->id]);
 
        return back()->with('success', "Chat created successfully");
        //dd(\Auth::id());
        //$request->message->chat()->create($request->only('title', 'summary'));
        //return back()->with('success', "New chat created successfully");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
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
