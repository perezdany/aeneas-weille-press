<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'label',
        'date_added',
        'hour_added',
        'path_file_en',
        'path_file_fr'
    ];
}
