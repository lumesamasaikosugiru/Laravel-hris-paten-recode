<?php

namespace App\Models\Recruitment;

use Illuminate\Database\Eloquent\Model;

class ApplicantExperience extends Model
{
    protected $fillable = [
        'applicant_biodata_id',
        'company',
        'position',
        'start_date',
        'end_date',
        'description',
    ];

    protected function casts(): array
    {
        return [
            'start_date' => 'date',
            'end_date' => 'date',
        ];
    }

    // Accessor: masih bekerja di sini
    public function getIsCurrentAttribute(): bool
    {
        return is_null($this->end_date);
    }

    // Accessor: durasi kerja (dalam bulan)
    public function getDurationMonthsAttribute(): int
    {
        $end = $this->end_date ?? now();
        return (int) $this->start_date->diffInMonths($end);
    }

    public function applicantBiodata()
    {
        return $this->belongsTo(ApplicantBiodata::class);
    }
}
