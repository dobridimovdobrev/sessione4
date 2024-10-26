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
    ];

    //Pivot rel
    public function movies()
    {
        return $this->belongsToMany(Movie::class, 'movie_trailer', 'trailer_id', 'movie_id');
    }

     // Relationship with TV Series
     public function tvSeries()
     {
         return $this->belongsToMany(TvSerie::class, 'tv_series_trailer', 'trailer_id', 'tv_series_id');
     }
 
     // Relationship with Seasons
     public function seasons()
     {
         return $this->belongsToMany(Season::class, 'season_trailer', 'trailer_id', 'season_id');
     }
}
