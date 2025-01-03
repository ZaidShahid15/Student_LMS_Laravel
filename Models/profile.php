<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class profile extends Model
{
    use HasFactory;
    protected $table = 'profiles';
    protected $fillable = ['pic','phone','address','user_id'];
    public function user()
    {
        return $this->belongsTo(User::class); // 'profile_id' as foreign key
    }


}
