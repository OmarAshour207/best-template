<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Spatie\Translatable\HasTranslations;

class Testimonial extends Model
{
    use HasTranslations;

    protected $fillable = [
        'name',
        'title',
        'stars',
        'description',
        'status',
        'meta_tag',
        'image'
    ];

    public $translatable = [
        'name',
        'title',
        'description',
        'meta_tag'
    ];

    // strip tags to customize unicode
    protected function asJson($value)
    {
        return json_encode($value, JSON_UNESCAPED_UNICODE);
    }

    public function getThumbImageAttribute()
    {
        return Storage::url('public/testimonials/thumbnail/' . $this->image);
    }

    public function getTestimonialImageAttribute()
    {
        return Storage::url('public/testimonials/' . $this->image);
    }
}
