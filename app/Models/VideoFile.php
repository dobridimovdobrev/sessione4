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
        'format',
        'size',
        'resolution',
        'duration',
    ];

    //Pivot relationship

    public function movies()
    {
        return $this->belongsToMany(Movie::class, 'movie_video_file', 'video_file_id', 'movie_id');
    }

     // Relationship with TV Series
     public function tvSeries()
     {
         return $this->belongsToMany(TvSerie::class, 'tv_series_video_file', 'video_file_id', 'tv_series_id');
     }
 
     // Relationship with Seasons
     public function seasons()
     {
         return $this->belongsToMany(Season::class, 'season_video_file', 'video_file_id', 'season_id');
     }
 
     // Relationship with Episodes
     public function episodes()
     {
         return $this->belongsToMany(Episode::class, 'episode_video_file', 'video_file_id', 'episode_id');
     }
}
