<?php

namespace App\Http\Controllers;

use App\Reply;
use Illuminate\Http\Request;
use App\Message;
use App\Msisdn;
use App\Http\Requests\ReplyRequest;

class RepliesController extends Controller
{
    public function __construct() {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
   
    public function store(Message $message, Request $request)
    {
        
        //dd('fuckkkkkkkkkkkk');
        $message->replies()->create( $request->validate(['body' => 'required' ]) + ['user_id' => \Auth::id()]);
 
        return back()->with('success', "Reply sent successfully");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Reply  $reply
     * @return \Illuminate\Http\Response
     */
    
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Reply  $reply
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Reply $reply)
    {
        //
    }

    
}
