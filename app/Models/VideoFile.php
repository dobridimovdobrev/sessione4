<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class VideoFile extends Model
{
    use HasFactory, SoftDeletes;



    protected $table = 'video_files';
    protected $primaryKey = 'video_file_id';

    protected $fillable = [
        'url',
        'content_id',
        'content_type',
        'format',
        'size',
        'resolution',
        'duration',
    ];

    //Polymorphic relationship

    public function content()
    {
        return $this->morphTo();
    }
}
