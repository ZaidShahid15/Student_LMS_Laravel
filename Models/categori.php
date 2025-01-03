<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class categori extends Model
{
    use HasFactory;
    protected $table = 'categories';
    protected $fillable = ['name'];
      // A category has many books
      public function books()
      {
          return $this->hasMany(books::class);
      }
}
