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
        'format',
        'size',
        'width',
        'height'
    ];

    //Pivot RELATIONSHIP
    public function movies()
    {
        return $this->belongsToMany(Movie::class, 'movie_image', 'image_file_id', 'movie_id');
    }

     // Relationship with TV Series
     public function tvSeries()
     {
         return $this->belongsToMany(TvSerie::class, 'tv_series_image', 'image_file_id', 'tv_series_id');
     }
 
     // Relationship with Seasons
     public function seasons()
     {
         return $this->belongsToMany(Season::class, 'season_image', 'image_file_id', 'season_id');
     }
 
     // Relationship with Episodes
     public function episodes()
     {
         return $this->belongsToMany(Episode::class, 'episode_image', 'image_file_id', 'episode_id');
     }

       // Relationship with Actors
    public function persons()
    {
        return $this->belongsToMany(Person::class, 'person_image', 'image_file_id', 'person_id');
    }
}
