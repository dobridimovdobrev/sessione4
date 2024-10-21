<?php

namespace App\Models;

use App\Traits\HasSlug;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Episode extends Model
{
    use HasFactory, SoftDeletes, HasSlug;

    protected $table = 'episodes';
    protected $primaryKey = 'episode_id';

    protected $fillable = [
        'title',
        'slug',
        'description',
        'episode_number',
        'duration',
        'status',
        'season_id',
    ];


    // Relationships  


    // An episode belongs to a season
    public function season()
    {
        return $this->belongsTo(Season::class, 'season_id');
    }

    // Polymorphic relationship for image files (posters)
    public function imageFiles()
    {
        return $this->morphMany(ImageFile::class, 'content');
    }

    // Polymorphic relationship for video files
    public function videoFiles()
    {
        return $this->morphMany(VideoFile::class, 'content');
    }

    // Polymorphic relationship for views
    public function views()
    {
        return $this->morphMany(View::class, 'content');
    }

    // Polymorphic relationship for histories
    public function histories()
    {
        return $this->morphMany(History::class, 'content');
    }

    // A episode can have many associated persons (actors)
    public function contentPersons()
    {
        return $this->morphMany(ContentPerson::class, 'content');
    }
}
