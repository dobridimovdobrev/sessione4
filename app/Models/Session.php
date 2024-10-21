<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Session extends Model
{
    use HasFactory;

    protected $table = 'sessions';
    protected $primaryKey = 'session_id';
    protected $fillable = [
        
        'user_id',
        'ip_address',
        'last_activity'
    ];

    public function users(){
        $this->belongsTo(User::class, 'user_id');
    }
}


