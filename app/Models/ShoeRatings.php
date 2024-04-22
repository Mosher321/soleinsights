<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ShoeRatings extends Model
{
    use HasFactory;

    protected $table = "shoe_ratings";
    public $timestamps = false;
    protected $fillable = [
        'user_id',
        'shoe_id',
        'rating'
    ];
}
