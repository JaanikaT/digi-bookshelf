<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PublicationType extends Model
{
    use HasFactory;

    protected $fillable = ['publication_type'];

    // A PublicationType has many Books
    public function books()
    {
        return $this->hasMany(Book::class);
    }
}
