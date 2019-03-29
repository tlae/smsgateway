<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Message;

class MisuseController extends Controller
{
    public function __construct() {
		$this->middleware('auth');
	}

    public function store(Message $message) {
    	$misuse = $message->misuse()->create([
    					'user_id' => auth()->id(),
    					'category' => request()->category,
    				]);
    	$message->phone()->increment('misuses_count');
    	$message->misuse_id = $misuse->id;
    	$message->save();
 
    	return back();
    }
}
