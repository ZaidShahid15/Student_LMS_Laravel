<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class books extends Model
{
    use HasFactory;
    protected $fillable = ['title','category_id','author_id','isbn','published_year'];
     // A book belongs to one category
    public function category()
    {
         return $this->belongsTo(categori::class);
    }

     // A book belongs to one author
    public function author()
    {
        return $this->belongsTo(auther::class);
    }

    public function issuedRecords()
    {
        return $this->hasMany(book_issued_students::class, 'book_id');
    }
}
