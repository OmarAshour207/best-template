<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Spatie\Translatable\HasTranslations;

class Page extends Model
{
    use HasTranslations;

    protected $fillable = [
        'title',
        'slug',
        'description',
        'image',
        'status'
    ];

    public $translatable = [
        'title',
        'description',
    ];

    // strip tags to customize unicode
    protected function asJson($value)
    {
        return json_encode($value, JSON_UNESCAPED_UNICODE);
    }

    public function getPageImageAttribute()
    {
        return Storage::url('public/pages/' . $this->image);
    }

    public function getThumbImageAttribute()
    {
        return Storage::url('public/pages/thumbnail/' . $this->image);
    }
}
