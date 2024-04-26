<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Blog extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia;
    protected $guarded = [];

    public function blogCategory()
    {
        return $this->belongsTo(BlogCategory::class, 'blog_category'); // Assuming 'blog_category' is the foreign key in your 'blogs' table
    }

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('blogs');
        $this->addMediaCollection('home')->singleFile();
    }
}
