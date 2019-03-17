<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Chat extends Model
{
     protected $fillable = ['title', 'summary', 'slug','message_id', 'user_id'];
    public function messages() {
		return $this->hasMany(Message::class);
	}
	public function user() {
		return $this->belongsTo(User::class);
	}
	public function getUrlAttribute() {
		return route('chats.show', $this->slug);
	}

	public function setTitleAttribute($value) {
		$this->attributes['title'] = $value;
		$this->attributes['slug'] = str_slug($value, $separator = '-');

	}
	
	public function getSummaryHtmlAttribute() {
		return \Parsedown::instance()->text($this->summary);
	}
}
