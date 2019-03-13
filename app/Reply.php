<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;
use App\Message;
use App\Chat;
use App\Msisdn;

class Reply extends Model
{
    protected $fillable = ['body', 'user_id'];
    public function user() {
		return $this->belongsTo(User::class);
	}
	public function message() {
		return $this->belongsTo(Message::class);
	}
	public function chat() {
		return $this->belongsTo(Chat::class);
	}
	public function getCreatedDateAttribute() {
		return $this->created_at->diffForHumans();
	}
	public static function boot()
 	{
 		parent::boot();
 		static::created(function ($reply){
 			$reply->message->increment('replies_count');
 			$reply->message->save();
 			$msisdn = Msisdn::find($reply->message->msisdn);
 			$msisdn->last_message_replied = 1;
 			$msisdn->messages_unread_count = 0;
 			$msisdn->save();



 		});
 	}
}
