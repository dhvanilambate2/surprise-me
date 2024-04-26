<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VideoDetails extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia;

    protected $guarded = [];

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('videos');
    }
    
    protected $fillable = ['video_url'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function homeDetails()
    {
        return $this->belongsTo(HomeDetails::class);
    }
}