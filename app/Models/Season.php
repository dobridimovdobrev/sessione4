<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Season extends Model
{
    use HasFactory;

    protected $table = 'seasons';
    protected $primaryKey = 'season_id';

    protected $fillable = [
        'tv_series_id',
        'season_number',
        'name',
        'overview',
        'total_episodes',
        'year',
        'premiere_date'
    ];

    //RELATIONSHIPS

    public function tvSeries()
    {
        return $this->belongsTo(TvSerie::class, 'tv_series_id', 'tv_series_id');
    }

    public function episodes()
    {
        return $this->hasMany(Episode::class, 'season_id', 'season_id');
    }

    public function persons()
    {
        return $this->belongsToMany(Person::class, 'season_person', 'season_id', 'person_id');
    }
}
