<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class HomeDetails extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia;
    protected $guarded = [];

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('images');
        $this->addMediaCollection('main_image')->singleFile(); // New 'main_image' collection
        $this->addMediaCollection('videos')->singleFile(); // New 'videos' collection
        $this->addMediaCollection('home')->singleFile();
        
    }
  
    public function videos()
    {
        return $this->hasMany(VideoDetails::class);
    }
    
    public function wishlist()
    {
        return $this->hasMany(Wishlist::class, 'property_id');
    }
}
