<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    protected $fillable = ['tag', 'user_id' ];

    // Optional: force lowercase tags
    public function setTagAttribute($value)
    {
        $this->attributes['tag'] = strtolower($value);
    }

    public function books()
    {
        return $this->belongsToMany(Book::class, 'book_tag_user')
            ->withPivot('user_id')
            ->withTimestamps();
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}