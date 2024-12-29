<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class book_issued_students extends Model
{
    use HasFactory;

    // Define the fillable fields for mass assignment
    protected $fillable = ['user_id', 'book_id', 'issued_at', 'due_date', 'returned_at'];

    // Define relationship with the User model (each issued book belongs to a single student)
    public function students()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    // Define relationship with the Book model (each issued book belongs to a single book)
    public function book()
    {
        return $this->belongsTo(books::class, 'book_id');
    }
}
