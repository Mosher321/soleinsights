<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Shoe extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'title',
        'body',
        'specs',
        'pros',
        'cons',
        'image_path'
    ];

    public function author(){
        return $this->hasOne(User::class, 'id', 'user_id');
    }
}
