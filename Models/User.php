<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role_id',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

      // Define relationship with BookIssuedStudent
      public function issuedBooks()
      {
        return $this->hasMany(book_issued_students::class);
      }


      // Define relationship with BookIssuedStudent
      public function role()
      {
        return $this->belongsTo(roles::class,'name'); // Assuming 'role_id' is the foreign key in the users table
      }


      static public function getRecored($search = null)
      {
          $query = User::select('users.*', 'roles.name as role_name')
              ->join('roles', 'roles.id', '=', 'users.role_id');

          // Apply the search filter if the search term is provided
          if ($search) {
              $query->where('users.name', 'like', '%' . $search . '%');
          }

          return $query->get(); // Execute the query
      }


    public function profile()
    {
        return $this->hasOne(Profile::class);
    }



}
