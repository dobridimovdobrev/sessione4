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
        'year',
        'duration',
        'imdb_rating',
        'total_seasons',
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

     // Pivot Relations
      // Trailers for the entire TV series
    public function trailers()
    {
        return $this->belongsToMany(Trailer::class, 'tv_series_trailer', 'tv_series_id', 'trailer_id');
    }

    // Images for the TV series
    public function imageFiles()
    {
        return $this->belongsToMany(ImageFile::class, 'tv_series_image', 'tv_series_id', 'image_file_id');
    }

    // Actors associated with the entire series
    public function persons()
    {
        return $this->belongsToMany(Person::class, 'tv_series_person', 'tv_series_id', 'person_id');
    }

}
