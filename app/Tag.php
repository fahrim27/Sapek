<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\SoftDeletes;

class Tag extends Model
{
     use SoftDeletes;

     protected $fillable = ['name'];

     public function blog()
     {
     	return $this->belongsToMany('App\Blog');
     }
}
