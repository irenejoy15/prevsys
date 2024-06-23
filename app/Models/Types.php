<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Types extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'type_name',
    ];

    protected $casts = [
        'id' => 'string',
    ];
}
