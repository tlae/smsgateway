<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Reply;
use App\Chat;
use App\Msisdn;
use App\CorruptionRelated;

class Message extends Model
{
    protected $fillable = ['body', 'msisdn', 'name','replies_count'];

    public function replies() {
		return $this->hasMany(Reply::class);
	}
	public function chat() {
		return $this->belongsTo(Chat::class);
	}
	public function phone() {
		return $this->belongsTo(Msisdn::class, 'msisdn');
	}
	public function misuse() {
		return $this->hasOne(Misuse::class);
	}
	public function corruptionRelated() {
		return $this->hasOne(CorruptionRelated::class);
	}
	public function getUrlAttribute() {
		return route("messages.show", [$this->id, $this->msisdn]);
	}
	public function getCreatedDateAttribute() {
		return $this->created_at->toDayDateTimeString();
	}
	public function getisCorruptionRelatedAttribute($message) {
		//
		
	}
	public function getChatCountAttribute() {
		
	}
	public static function boot()
 	{
 		parent::boot();
 		static::created(function ($message){

 			$msisdn = Msisdn::firstOrNew(['msisdn' => $message->msisdn]);
 			$msisdn->save();
 			$msisdn->increment('messages_count');
 			$msisdn->increment('messages_unread_count');
 			$msisdn->last_message_id = $message->id; 
 			$msisdn->last_message_replied = 0;		
 			$msisdn->save();
 		});

 	}
}
