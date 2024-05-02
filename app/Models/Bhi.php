<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bhi extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'name_file',
        'file_path',
        'date_added',
    ];
}
