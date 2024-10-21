<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Person extends Model
{
    use HasFactory;

    protected $table = 'persons';
    protected $primaryKey = 'person_id';

    protected $fillable = [
        'name'
    ];

    //Relationship polymorphic

    public function contentPersons()
    {
        return $this->morphMany(ContentPerson::class, 'content');
    }

    public function image()
    {
        return $this->morphOne(ImageFile::class, 'content');
    }
}
