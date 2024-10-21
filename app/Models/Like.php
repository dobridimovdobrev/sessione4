<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Like extends Model
{
    use HasFactory, SoftDeletes;


    protected $table = 'likes';
    protected $primaryKey = 'like_id';
    protected $fillable = [
        'content_id',
        'content_type',
        'user_id',
    ];



      // A like belongs to a user
      public function user()
      {
          return $this->belongsTo(User::class, 'user_id');
      }
  
      // A like belongs to a specific content type (movie, episode, etc.)
      public function content()
      {
          return $this->morphTo();
      }
}
