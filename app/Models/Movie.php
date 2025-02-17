<?php

namespace App\Models;

use App\Traits\HasCache;
use App\Traits\HasSlug;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Movie extends Model
{
    use HasFactory, SoftDeletes, HasSlug, HasCache;

    protected $table = 'movies';
    protected $primaryKey = 'movie_id';

    protected $fillable = [
        'title',
        'slug',
        'description',
        'year',
        'duration',
        'imdb_rating',
        'status',
        'category_id',
        'premiere_date'
    ];

    protected $casts = [
        'premiere_date' => 'date',
        'imdb_rating' => 'float'
    ];

    protected $hidden = ['created_at', 'updated_at', 'deleted_at'];



    // Relationships

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }
 

    public function persons()
    {
        return $this->belongsToMany(Person::class, 'movie_person', 'movie_id', 'person_id');
    }

    // Relationship with images
    public function imageFiles()
    {
        return $this->belongsToMany(ImageFile::class, 'movie_image', 'movie_id', 'image_file_id')
                    ->withPivot('type')
                    ->withTimestamps();
    }

    // Relationship with trailers
    public function trailers()
    {
        return $this->belongsToMany(Trailer::class, 'movie_trailer', 'movie_id', 'trailer_id');
    }

    // Relationship with video files
    public function videoFiles()
    {
        return $this->belongsToMany(VideoFile::class, 'movie_video_file', 'movie_id', 'video_file_id');
    }

}
