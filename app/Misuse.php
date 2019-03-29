<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Message;

class Misuse extends Model
{
    protected $table = 'misuses';
    protected $fillable = ['user_id', 'category', 'message_id']; 

    public function message() {
    	return $this->belongsTo(Message::class);
    }
}
