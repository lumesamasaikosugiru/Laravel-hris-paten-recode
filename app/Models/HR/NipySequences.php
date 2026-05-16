<?php

namespace App\Models\HR;

use Illuminate\Database\Eloquent\Model;

class NipySequences extends Model
{
    protected $fillable = [
        'year',
        'education_code',
        'category_code',
        'last_number',
    ];

    protected function casts(): array
    {
        return [
            'last_number' => 'integer',
        ];
    }

    // JANGAN tambah method generate di sini.
    // Logic generate NIPY HANYA ada di NipyService.
}
