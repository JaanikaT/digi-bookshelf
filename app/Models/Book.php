<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;

    protected $fillable = [
        'title', 
        'isbn', 
        'description', 
        'publication_year', 
        'publisher', 
        'pages', 
        'cover', 
        'author_id', 
        'language_id', 
        'category_id', 
        'publication_type_id'
    ];

    // Define relationships

    // A Book belongs to many Authors
    public function authors()
    {
        return $this->belongsToMany(Author::class, 'book_author');
    }

    // A Book belongs to one Language
    public function language()
    {
        return $this->belongsTo(Language::class);
    }

    // A Book belongs to many Categories
    public function category()
    {
        return $this->hasMany(Category::class);
    }

    // A Book belongs to one PublicationType
    public function publicationType()
    {
        return $this->belongsTo(PublicationType::class);
    }
}
