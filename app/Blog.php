<?php

namespace App;

use App\Helper\MySlugHelper;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Spatie\Sluggable\HasTranslatableSlug;
use Spatie\Sluggable\SlugOptions;
use Spatie\Translatable\HasTranslations;

class Blog extends Model
{
    use HasTranslations, HasTranslatableSlug;

    protected $fillable = [
        'title',
        'slug',
        'content',
        'author',
        'meta_tag',
        'image'
    ];

    public $translatable = [
        'title',
        'slug',
        'content',
        'author',
        'meta_tag'
    ];

    public function getSlugOptions() : SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('title')
            ->saveSlugsTo('slug');
    }

    // this override function to customize arabic language
    protected function generateNonUniqueSlug(): string
    {
        $slugField = $this->slugOptions->slugField;

        if ($this->hasCustomSlugBeenUsed() && ! empty($this->$slugField)) {
            return $this->$slugField;
        }

        return MySlugHelper::slug($this->getSlugSourceString());
//        return Str::slug($this->getSlugSourceString(), $this->slugOptions->slugSeparator, $this->slugOptions->slugLanguage);
    }

    // strip tags to customize unicode
    protected function asJson($value)
    {
        return json_encode($value, JSON_UNESCAPED_UNICODE);
    }

    // change route from id to slug
    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function getBlogImageAttribute()
    {
        return Storage::url('public/blogs/' . $this->image);
    }

    public function getThumbImageAttribute()
    {
        return Storage::url('public/blogs/thumbnail/' . $this->image);
    }
}
