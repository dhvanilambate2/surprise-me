<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Wishlist extends Model
{
    use HasFactory;
    
     protected $fillable = [
        'user_id','property_id'
    ];
    public function homeDetails()
    {
        return $this->belongsTo(HomeDetails::class, 'property_id');
    }
    public function Users()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
