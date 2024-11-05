<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LinuxCommand extends Model
{
    protected $fillable = [
        'command',
        'description',
        'category',
        'examples',
        'flags'
    ];

    protected $casts = [
        'examples' => 'array',
        'flags' => 'array'
    ];
}
