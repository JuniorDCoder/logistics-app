<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Service extends Model
{
    use HasFactory;

    protected $fillable = [
        'title', 'slug', 'description', 'short_description',
        'icon', 'image', 'is_active', 'sort_order'
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];
}
