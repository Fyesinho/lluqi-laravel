<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;
use Spatie\MediaLibrary\HasMedia\Interfaces\HasMedia;

class Testimonial extends Model implements HasMedia{

    use HasMediaTrait;

    public $fillable = [
        'id',
        'description',
        'user',
    ];

}
