<?php

namespace App\Models\Image;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    use HasFactory;

    protected $table = 'image';

    protected $fillable = [
        'name',
        'file',
        'enable',
    ];
}
