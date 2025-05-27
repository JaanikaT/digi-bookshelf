<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

class BookUser extends Pivot
{
    protected $table = 'book_user';

    protected $fillable = [
        'notes',
        'rating',
        'reading_start',
        'current_page',
        'reading_end',
        'reading_status',
    ];

    public static function readingStatuses(): array
    {
        return [
            'wishlist' => 'Soovin lugeda',
            'to be read' => 'Ootel',
            'in progress' => 'Pooleli',
            'pause' => 'Pausil',
            'read' => 'Loetud',
            'do not finish' => 'Ei lõpeta',
        ];
    }

    public function getReadingStatusLabelAttribute(): string
    {
        return self::readingStatuses()[$this->reading_status] ?? '';
    }




}
