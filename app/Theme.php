<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Theme extends Model
{
    protected $fillable = [
        'ar_title',
        'en_title',
        'status'
    ];
}
