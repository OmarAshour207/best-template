<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Spatie\Translatable\HasTranslations;

class TeamMember extends Model
{
    use HasTranslations;

    protected $fillable = [
        'name',
        'title',
        'description',
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

    // Attributes
    public function getMemberImageAttribute()
    {
        return Storage::url('public/team-members/' . $this->image);
    }

    public function getThumbImageAttribute()
    {
        return Storage::url('public/team-members/thumbnail/' . $this->image);
    }
}
