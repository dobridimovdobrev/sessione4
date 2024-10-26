<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Season extends Model
{
    use HasFactory,SoftDeletes;

    protected $table = 'seasons';
    protected $primaryKey = 'season_id';

    protected $fillable = [
        'season_number',
        'total_episodes',
        'year',
        'premiere_date',
        'tv_series_id',
    ];

    //RELATIONSHIPS

    public function tvSeries()
    {
        return $this->belongsTo(TVSerie::class, 'tv_series_id');
    }

    public function episodes()
    {
        return $this->hasMany(Episode::class, 'season_id');
    }

    public function trailers()
    {
        return $this->belongsToMany(Trailer::class, 'season_trailer', 'season_id', 'trailer_id');
    }

    public function imageFiles()
    {
        return $this->belongsToMany(ImageFile::class, 'season_image', 'season_id', 'image_file_id');
    }

    public function persons()
    {
        return $this->belongsToMany(Person::class, 'season_person', 'season_id', 'person_id');
    }

    // Polymorphic relationship 

    public function likes()
    {
        return $this->morphMany(Like::class, 'content');
    }

    public function views()
    {
        return $this->morphMany(View::class, 'content');
    }

    public function histories()
    {
        return $this->morphMany(History::class, 'content');
    }

   

}