<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Chat extends Model
{
     protected $fillable = ['title', 'summary', 'slug','message_id'];
    public function messages() {
		return $this->hasMany(Message::class);
	}

	public function setTitleAttribute($value) {
		$this->attributes['title'] = $value;
		$this->attributes['slug'] = str_slug($value, $separator = '-');

	}
}
