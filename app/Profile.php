<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Profile extends Model
{	
	use SoftDeletes;

    protected $fillable = ['city', 'state', 'phone', 'full_address'];

    public function users()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
