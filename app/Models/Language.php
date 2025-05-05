<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Language extends Model
{
    use HasFactory;

    protected $fillable = ['language', 'language_code'];

    // A Language has many Books
    public function books()
    {
        return $this->hasMany(Book::class);
    }
}
