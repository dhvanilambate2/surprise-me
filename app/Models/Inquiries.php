<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Inquiries extends Model
{
    use HasFactory;
    
    public function HomeDetails()
    {
        return $this->belongsTo(HomeDetails::class, 'hid'); // Assuming 'blog_category' is the foreign key in your 'blogs' table
    }

}
