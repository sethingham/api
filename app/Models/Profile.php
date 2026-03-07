<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    /** @use HasFactory<\Database\Factories\ProfileFactory> */
    use HasFactory;

    /** @var list<string> */
    protected $fillable = [
        'name',
        'headline',
        'bio',
        'avatar',
        'email',
    ];
}
