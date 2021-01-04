<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ContactNotification extends Model
{
    protected $fillable = [
        'name',
        'content',
        'status'
    ];

}
