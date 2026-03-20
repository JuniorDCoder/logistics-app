<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class TeamMember extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'position', 'bio', 'photo',
        'linkedin', 'twitter', 'email', 'is_active', 'sort_order'
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];
}
