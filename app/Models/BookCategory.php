<?php

// app/Models/BookCategory.php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BookCategory extends Model
{
    use HasFactory;

    // Define the many-to-many relationship with books
    public function books()
    {
        return $this->belongsToMany(Book::class, 'book_category');
    }
}
