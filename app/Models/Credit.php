<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Credit extends Model
{
    use HasFactory;

    protected $table = 'credits';
    protected $primaryKey = 'credit_id';

    protected $fillable = [
        'user_id',
        'total_credits',
        'spent_credits',
        'remaining_credits',
        'update_date'
    ];

    // Relationships
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
