<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Spatie\Translatable\HasTranslations;

class Slider extends Model
{
    use HasTranslations;

    protected $fillable = [
        'title',
        'description',
        'image',
    ];

    public $translatable = [
        'title',
        'description'
    ];

    // strip tags to customize unicode
    protected function asJson($value)
    {
        return json_encode($value, JSON_UNESCAPED_UNICODE);
    }


    // Attributes
    public function getSliderImageAttribute()
    {
        return Storage::url('public/slider/' . $this->image);
    }

    public function getThumbImageAttribute()
    {
        return Storage::url('public/thumbnail/' . $this->image);
    }

}
