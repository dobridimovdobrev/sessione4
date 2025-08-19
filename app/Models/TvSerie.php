<?php

namespace App\Models;

use App\Traits\HasCache;
use App\Traits\HasSlug;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class TvSerie extends Model
{
    use HasFactory,SoftDeletes,HasSlug, HasCache;

    protected $table = 'tv_series';
    protected $primaryKey = 'tv_series_id';

    protected $fillable = [
        'title',
        'description',
        'slug',
        'year',
        'total_episodes',
        'imdb_rating',
        'total_seasons',
        'status',
        'category_id',
        // 'tmdb_id', // Removed from fillable - will be set separately when needed
        'premiere_date'
    ];

    protected $casts = [
        'premiere_date' => 'date',
        'imdb_rating' => 'float',
        'total_episodes' => 'integer',
        'total_seasons' => 'integer',
        'year' => 'integer'
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
        return $this->belongsToMany(ImageFile::class, 'tv_series_image', 'tv_series_id', 'image_file_id')
                    ->withPivot('type')
                    ->withTimestamps();
    }

    // Actors associated with the entire series
    public function persons()
    {
        return $this->belongsToMany(Person::class, 'tv_series_person', 'tv_series_id', 'person_id');
    }

    // Video files for the TV series (trailers, etc.)
    public function videoFiles()
    {
        return $this->belongsToMany(VideoFile::class, 'tv_series_video_file', 'tv_series_id', 'video_file_id');
    }

}
