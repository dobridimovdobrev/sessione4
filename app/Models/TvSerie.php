<?php

namespace App\Models;

use App\Traits\HasSlug;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class TvSerie extends Model
{
    use HasFactory,SoftDeletes,HasSlug;

    protected $table = 'tv_series';
    protected $primaryKey = 'tv_series_id';

    protected $fillable = [
        'title',
        'slug',
        'description',
        'year',
        'duration',
        'imdb_rating',
        'total_seasons',
        'premiere_date',
        'status',
        'category_id',
    ];

    //RELATIONSHIPS

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    public function seasons()
    {
        return $this->hasMany(Season::class, 'tv_series_id');
    }

    //Polymorphic relationships

     // A TV series can have many likes
     public function likes()
     {
         return $this->morphMany(Like::class, 'content');
     }
 
     // A TV series can be in many lists
     public function myLists()
     {
         return $this->morphMany(MyList::class, 'content');
     }
 
     // A TV series can have many views
     public function views()
     {
         return $this->morphMany(View::class, 'content');
     }
 
     // A TV series can have many histories
     public function histories()
     {
         return $this->morphMany(History::class, 'content');
     }
     //Trailers
     public function trailers()
     {
         return $this->morphMany(Trailer::class, 'content');
        }
        //Video files
        public function videoFiles()
        {
            return $this->morphMany(VideoFile::class, 'content');
        }
        //Images
        public function images()
        {
            return $this->morphMany(ImageFile::class, 'content');
        }
        // Actors
       public function contentPersons()
       {
           return $this->morphMany(ContentPerson::class, 'content');
       }
}
