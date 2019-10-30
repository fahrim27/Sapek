<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Inbox extends Model
{
    use SoftDeletes;

    protected $fillable = ['subject', 'message'];
}
