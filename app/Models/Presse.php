<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Presse extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'name_presse',
        'url_address',
    ];
}
