<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Hero extends Model
{
    protected $fillable = [
        'hero_image',
        'title',
        'subtitle',
        'button_text'
    ];


}
