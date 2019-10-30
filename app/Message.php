<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
	protected $guarded = ['message' ];

    public function user()
    {
    	return $this->belongsTo(User::class, 'from');
    }
}
