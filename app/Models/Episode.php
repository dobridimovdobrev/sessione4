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

     // Video files for each episode
     public function videoFiles()
     {
         return $this->belongsToMany(VideoFile::class, 'episode_video_file', 'episode_id', 'video_file_id');
     }
 
     // Images for an episode (optional)
     public function imageFiles()
     {
         return $this->belongsToMany(ImageFile::class, 'episode_image', 'episode_id', 'image_file_id');
     }
 
     // Actors for each episode 
     public function persons()
     {
         return $this->belongsToMany(Person::class, 'episode_person', 'episode_id', 'person_id');
     }
    

}
