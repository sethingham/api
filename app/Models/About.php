<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class About extends Model
{
    /** @use HasFactory<\Database\Factories\AboutFactory> */
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
