<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Trailer extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'trailers';
    protected $primaryKey = 'trailer_id';

    protected $fillable = [
        'url',
        'content_id',
        'content_type',
    ];

    //Polymorphic relationship
    public function content()
    {
        return $this->morphTo();
    }
}
