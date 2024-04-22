<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ShoeComments extends Model
{
    use HasFactory;

    protected $table = "shoe_comments";
    public $timestamps = false;
    protected $fillable = [
        'user_id',
        'shoe_id',
        'comment',
        'status'
    ];

    public function author(){
        return $this->hasOne(User::class, 'id', 'user_id');
    }
}
