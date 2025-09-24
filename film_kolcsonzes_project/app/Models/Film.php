<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Film extends Model
{

     protected $fillable = [
        'title',
        'director',
        'release_year',
        'how_long', 
    ];

}

