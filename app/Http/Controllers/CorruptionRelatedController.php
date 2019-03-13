<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Message;

class CorruptionRelatedController extends Controller
{
    public function __construct() {
		$this->middleware('auth');
	}

    public function store(Message $message) {
    	$corRelated = $message->corruptionRelated()->create([
    					'user_id' => auth()->id(), 
    					'message_id' => $message->id,
    				]);
    	$message->phone()->increment('corruption_related_count');
    	$message->corruption_related_id=$corRelated->id;
    	$message->save();

 
    	return back();
    }
}
