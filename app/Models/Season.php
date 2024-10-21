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

    public function trailers()
    {
        return $this->morphMany(Trailer::class, 'content');
    }

    public function images()
    {
        return $this->morphMany(ImageFile::class, 'content');
    }

     public function contentPersons()
     {
         return $this->morphMany(ContentPerson::class, 'content');
     }

}
