<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Formula extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'payload',
        'user_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
