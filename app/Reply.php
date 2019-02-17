<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;
use App\Message;
use App\Chat;

class Reply extends Model
{
    public function user() {
		return $this->belongsTo(User::class);
	}
	public function message() {
		return $this->belongsTo(Message::class);
	}
	public function chat() {
		return $this->belongsTo(Chat::class);
	}
}
