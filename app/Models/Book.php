<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;

    protected $fillable = [
        'isbn',
        'title',
        'publisher_id',
        'author',
        'category_id',
        'qty',
        'image',
        'about',
        'publish_year'
    ];
}
