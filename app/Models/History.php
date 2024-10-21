<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class History extends Model
{
    use HasFactory,SoftDeletes;

    protected $table = 'histories';
    protected $primaryKey = 'history_id';
    protected $fillable = [
        'content_id',
        'content_type',
        'user_id',
        'start_date',
        'end_date',
        'progress',
    ];

     // A history belongs to a user
     public function user()
     {
         return $this->belongsTo(User::class, 'user_id');
     }
 
     // A history belongs to a specific content type (movie, episode, etc.)
     public function content()
     {
         return $this->morphTo();
     }
}
