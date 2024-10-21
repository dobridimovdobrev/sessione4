<?php

namespace App\Models;

use App\Traits\HasSlug;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Movie extends Model
{
    use HasFactory, SoftDeletes, HasSlug;

    protected $table = 'movies';
    protected $primaryKey = 'movie_id';

    protected $fillable = [
        'title',
        'slug',
        'description',
        'year',
        'duration',
        'imdb_rating',
        'premiere_date',
        'status',
        'category_id',
    ];


    // Relationships

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    public function imageFile()
    {
        return $this->morphMany(ImageFile::class, 'content');
    }

    public function likes()
    {
        return $this->morphMany(Like::class, 'content');
    }

    public function myLists()
    {
        return $this->morphMany(MyList::class, 'content');
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

    public function contentPersons()
    {
        return $this->morphMany(ContentPerson::class, 'content');
    }
}
