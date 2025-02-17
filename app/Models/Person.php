<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Person extends Model
{
    use HasFactory;

    protected $table = 'persons';
    protected $primaryKey = 'person_id';

    protected $fillable = [
        'name'
    ];

    //Relationship pivot

    public function movies()
    {
        return $this->belongsToMany(Movie::class, 'movie_person', 'person_id', 'movie_id');
    }

    // Relationship with TV Series
    public function tvSeries()
    {
        return $this->belongsToMany(TvSerie::class, 'tv_series_person', 'person_id', 'tv_series_id');
    }

    // Relationship with Seasons
    public function seasons()
    {
        return $this->belongsToMany(Season::class, 'season_person', 'person_id', 'season_id');
    }

    // Relationship with Episodes
    public function episodes()
    {
        return $this->belongsToMany(Episode::class, 'episode_person', 'person_id', 'episode_id');
    }

      // Relationship with Image Files
      public function imageFiles()
      {
          return $this->belongsToMany(ImageFile::class, 'person_image', 'person_id', 'image_file_id');
      }

}
