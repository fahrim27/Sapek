<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class replyComment extends Model
{	
	protected $fillable = ['content'];
	
    public function commentable()
	{
		return $this->morphTo();
	}

	public function user()
    {
    	return $this->belongsTo('App\user');
    }
}
