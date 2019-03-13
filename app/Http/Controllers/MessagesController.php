<?php

namespace App\Http\Controllers;

use App\Message;
use App\Msisdn;
use Illuminate\Http\Request;
use App\Http\Requests\MessageRequest;

class MessagesController extends Controller
{
    

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $messages = Message::with('phone')->join('msisdn', 'messages.id', '=', 'msisdn.last_message_id')
                                          ->select('messages.*', 'msisdn.last_message_id')->latest()->paginate(6);
        return view('messages.index', compact('messages'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $message = new Message();
        return view('messages.create', compact($message));

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(MessageRequest $request)
    {
        //$request->messages()->create($request->only('msisdn', 'body'));

        Message::create([
        'body' => $request->body,
        'msisdn' => $request->msisdn
    ]);

        return redirect()->route('messages.index')->with('Success', "Message received");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Message  $message
     * @return \Illuminate\Http\Response
     */
    public function show($message, $msisdn)
    {
      
      $messages = Message::with('replies.user')->where('msisdn', '=', $msisdn)->get();

      $newmsisdn = Msisdn::find($msisdn);

      if($newmsisdn->messages_unread_count > 0) {

        $newmsisdn->messages_unread_count = 0;
        $newmsisdn->save();
      }
      
        //return view('messages.show', compact('messages', 'msisdn'));
      return view('replies.showtest', compact('messages', 'msisdn'));

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Message  $message
     * @return \Illuminate\Http\Response
     */
    public function edit(Message $message)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Message  $message
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Message $message)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Message  $message
     * @return \Illuminate\Http\Response
     */
    public function destroy(Message $message)
    {
        //
    }
}
