<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'app_paginate_number',
        'app_theme',
        'app_max_decimal_place',
        'app_scalable',
        'user_id'
    ];
}
