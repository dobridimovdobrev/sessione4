<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Helpers\ImageHelper;

class ImageFile extends Model
{
    use HasFactory;

    protected $table = 'image_files';
    protected $primaryKey = 'image_id';

    protected $fillable = [
        'url',
        'title',
        'description',
        'type',
        'size_path',
        'base_path',
        'format',
        'size',
        'width',
        'height'
    ];

    // Accessor per ottenere l'URL completo
    public function getFullUrlAttribute()
    {
        // L'immagine è sempre sul nostro server in /storage
        return 'https://api.dobridobrev.com/storage/' . $this->url;
    }

    // Metodo per ottenere l'URL con una dimensione specifica
    public function getUrlWithSize($size)
    {
        return ImageHelper::getImageUrl($this, $size);
    }

    //Pivot RELATIONSHIP
    public function movies()
    {
        return $this->belongsToMany(Movie::class, 'movie_image', 'image_file_id', 'movie_id')
                    ->withPivot('type')
                    ->withTimestamps();
    }

    public function tvSeries()
    {
        return $this->belongsToMany(TvSerie::class, 'tv_series_image', 'image_file_id', 'tv_series_id')
                    ->withPivot('type')
                    ->withTimestamps();
    }

    public function episodes()
    {
        return $this->belongsToMany(Episode::class, 'episode_image', 'image_file_id', 'episode_id')
                    ->withPivot('type')
                    ->withTimestamps();
    }

    public function persons()
    {
        return $this->belongsToMany(Person::class, 'person_image', 'image_file_id', 'person_id')
                    ->withPivot('type')
                    ->withTimestamps();
    }
}
