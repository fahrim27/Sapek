<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ContactUs extends Model
{
    public $fillable = ['name', 'email', 'subject', 'message'];
}
