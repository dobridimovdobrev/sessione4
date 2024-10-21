<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    use HasFactory;
    protected $table = 'countries';
    protected $primaryKey = 'country_id';

    protected $fillable = [
        'name',
        'continent',
        'iso_char2',
        'iso_char3',
        'phone_prefix',
    ];
        //Relationship
    public function users()
    {
        return $this->hasMany(User::class, 'country_id');
    }
}
