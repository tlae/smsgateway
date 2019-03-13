<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Chat extends Model
{
    public function messages() {
		return $this->hasMany(Message::class);
	}

	public function setTitleAttributes($value) {
		$this->attributes['title'] = $value;
		$this->attributes['slug'] = str_slug($value, $separator = '-');

	}
}
