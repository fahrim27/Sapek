<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\SoftDeletes;

class Blog extends Model
{
    use SoftDeletes;

    protected $fillable = ['title', 'image', 'content'];

    public function tags()
	{
		return $this->belongsToMany('App\Tag');
	}

	public function comments()
	{
		return $this->morphMany('App\Comment', 'commentable');
	}

	public function user()
	{
		return $this->belongsTo('App\User');
	}
}
