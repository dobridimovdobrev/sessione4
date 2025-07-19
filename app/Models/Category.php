<?php

namespace App\Models;

use App\Traits\HasSlug;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Category extends Model
{
    use HasFactory, SoftDeletes, HasSlug;

    protected $table = 'categories';
    protected $primaryKey = 'category_id';

    protected $fillable = [
        'name',
        'slug'
    ];

    //Relationships
    public function movies()
    {
        return $this->hasMany(Movie::class, 'category_id');
    }

    public function tvSeries()
    {
        return $this->hasMany(TVSerie::class, 'category_id');
    }
}
