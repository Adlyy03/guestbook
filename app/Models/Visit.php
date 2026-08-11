<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Visit extends Model
{
    protected $table = 'visits';

    protected $fillable = [
        'guest_id',
        'check_in',
        'check_out',
    ];

    public function guest()
    {
        return $this->belongsTo(Guest::class);
    }
}