<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class View extends Model
{
    use HasFactory,SoftDeletes;

    protected $table = 'views';
    protected $primaryKey = 'view_id';
    protected $fillable = [
        'content_id',
        'content_type',
        'user_id',
        'view_date'
    ];


     // A view belongs to a user
     public function user()
     {
         return $this->belongsTo(User::class, 'user_id');
     }
 
     // A view belongs to a specific content type (movie, episode, etc.)
     public function content()
     {
         return $this->morphTo();
     }
}
