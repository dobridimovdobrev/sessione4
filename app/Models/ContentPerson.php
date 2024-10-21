<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ContentPerson extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'content_persons';
    protected $primaryKey = 'content_persons_id';
    protected $fillable = [
        'content_id',
        'content_type',
        'person_id'
    ];

        //Relationships 
       // A person can be associated with multiple content types (movies, series, etc.)
       public function content()
       {
           return $this->morphTo();
       }
   
       // A person belongs to a person model (actor)
       public function person()
       {
           return $this->belongsTo(Person::class, 'person_id');
       }
}
