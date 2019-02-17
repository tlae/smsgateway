<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Reply;
use App\Chat;

class Message extends Model
{
    public function replies() {
		return $this->hasMany(Reply::class);
	}
	public function chat() {
		return $this->belongsTo(Chat::class);
	}
}
