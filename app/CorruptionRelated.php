<?php

namespace App;


use Illuminate\Database\Eloquent\Model;
use App\Message;

class CorruptionRelated extends Model
{
    protected $table = 'corruption_related';
    protected $fillable = ['user_id']; 

    public function message() {
    	return $this->belongsTo(Message::class);
    }
}
