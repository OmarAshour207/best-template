<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class WebsiteSetting extends Model
{
    protected $fillable = [
        'page_filter',
        'color'
    ];

    protected $casts = [
        'page_filter'   => 'array'
    ];
}
