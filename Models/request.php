<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class request extends Model
{
    use HasFactory;
    protected $fillable = ['book_id', 'user_id', 'request'];

    public function book(){
        return $this->belongsTo(books::class);
    }

    public function user(){
        return $this->belongsTo(User::class);
    }
}
