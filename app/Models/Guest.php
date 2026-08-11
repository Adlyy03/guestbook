<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Guest extends Model
{
    protected $table = 'guests';

    protected $fillable = [
        'name',
        'email',
        'phone',
        'company',
        'purpose',
        'face_descriptor',
    ];

    public function visits()
    {
        return $this->hasMany(Visit::class);
    }
}