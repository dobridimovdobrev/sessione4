<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class User extends Authenticatable 
{
    use HasApiTokens, HasFactory, SoftDeletes;

    protected $table = 'users';
    protected $primaryKey = 'user_id';
    protected $fillable = [
        'username',
        'first_name',
        'last_name',
        'email',
        'password',
        'gender',
        'birthday',
        'user_status',
        'country_id',
        'role_id',
        'profile_image_id'
    ];

    protected $hidden = [
        'password',  // Hide the password hash attribute
        'remember_token', // Hide the remember token if used
    ];

    //Relationships

    
    //Session
    public function sessions(){
        return $this->hasMany(Session::class, 'user_id');
    }
    //Country
    public function country()
    {
        return $this->belongsTo(Country::class, 'country_id');
    }
    //Role
    public function role()
    {
        return $this->belongsTo(Role::class, 'role_id');
    }
    
    //Credits
    public function credits()
    {
        return $this->hasOne(Credit::class, 'user_id');
    }
    
    //Polymorphic relationships

    //Profile image
    public function profileImage()
    {
        return $this->morphOne(ImageFile::class, 'content'); // A user can have one profile image
    }

}
  