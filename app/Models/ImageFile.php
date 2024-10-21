<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ImageFile extends Model
{
    use HasFactory;

    protected $table = 'image_files';
    protected $primaryKey = 'image_id';

    protected $fillable = [
        'url',
        'title',
        'description',
        'content_id',
        'content_type',
        'format',
        'size',
        'width',
        'height'
    ];

    //Polymorphic RELATIONSHIPS
    public function content()
    {
        return $this->morphTo();
    }
}
