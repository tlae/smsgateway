<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Message;

class Msisdn extends Model
{
    protected $fillable = ['msisdn'];
    protected $table = 'msisdn';
	public  $incrementing = false;
	protected $primaryKey = 'msisdn';
	protected $keyType = 'string';
    public function messages() {
    	return $this->hasMany(Message::class, 'msisdn');
    }
}
