<?php

// app/Models/Book.php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;

    // Define the many-to-many relationship with categories
    public function categories()
    {
        return $this->belongsToMany(BookCategory::class, 'book_category');
    }
}
