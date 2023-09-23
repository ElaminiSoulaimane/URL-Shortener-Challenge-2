<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Url extends Model
{
    use HasFactory;
    protected $fillable = [
        'long_url', // Add 'long_url' to the fillable properties
        'short_url',
        'click_count',
    ];
}
