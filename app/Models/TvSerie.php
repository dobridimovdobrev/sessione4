<?php

namespace App\Models;

use App\Traits\HasSlug;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class TvSerie extends Model
{
    use HasFactory,SoftDeletes,HasSlug;

    protected $table = 'tv_series';
    protected $primaryKey = 'tv_series_id';

    protected $fillable = [
        'title',
        'description',
        'slug',
        'year',
        'duration',
        'imdb_rating',
        'total_seasons',
        'status',
        'category_id',
    ];

    //RELATIONSHIPS

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    public function seasons()
    {
        return $this->hasMany(Season::class, 'tv_series_id');
    }


     // Pivot Relations
      // Trailers for the entire TV series
    public function trailers()
    {
        return $this->belongsToMany(Trailer::class, 'tv_series_trailer', 'tv_series_id', 'trailer_id');
    }

    // Images for the TV series
    public function imageFiles()
    {
        return $this->belongsToMany(ImageFile::class, 'tv_series_image', 'tv_series_id', 'image_file_id');
    }

    // Actors associated with the entire series
    public function persons()
    {
        return $this->belongsToMany(Person::class, 'tv_series_person', 'tv_series_id', 'person_id');
    }

    // Relationship with video files
    public function videoFiles()
    {
        return $this->belongsToMany(VideoFile::class, 'movie_video_file', 'movie_id', 'video_file_id');
    }
}
