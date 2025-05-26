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
        'publication_type_id',
        'user_id',
    ];

    // Define relationships

    // A Book belongs to many Authors
    public function authors()
    {
        return $this->belongsToMany(Author::class, 'book_author')
        ->withTimestamps();
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

    public function users()
    {
        return $this->belongsToMany(User::class)
            ->withPivot(['notes', 'rating', 'reading_start', 'reading_end', 'current_page'])
            ->withTimestamps();
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class, 'book_tag_user')
            ->withPivot('user_id')
            ->withTimestamps();
    }
    
    
    
    
    public function creator()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

}
