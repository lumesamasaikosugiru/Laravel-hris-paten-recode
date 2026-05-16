<?php

namespace App\Models\Recruitment;

use Illuminate\Database\Eloquent\Model;

class ApplicantSkill extends Model
{
    protected $fillable = [
        'job_vacancy_id',
        'applicant_biodata_id',
        'status',
        'notes',
        'applied_at',
    ];

    protected function casts(): array
    {
        return [
            'applied_at' => 'datetime',
        ];
    }

    // Status constants — hindari magic string di seluruh codebase
    const STATUS_APPLIED = 'applied';
    const STATUS_SCREENING = 'screening';
    const STATUS_INTERVIEW = 'interview';
    const STATUS_ACCEPTED = 'accepted';
    const STATUS_REJECTED = 'rejected';

    public static function statuses(): array
    {
        return [
            self::STATUS_APPLIED => 'Melamar',
            self::STATUS_SCREENING => 'Screening',
            self::STATUS_INTERVIEW => 'Interview',
            self::STATUS_ACCEPTED => 'Diterima',
            self::STATUS_REJECTED => 'Ditolak',
        ];
    }

    // Scope
    public function scopeAccepted($query)
    {
        return $query->where('status', self::STATUS_ACCEPTED);
    }

    // Accessor: label status dalam bahasa Indonesia
    public function getStatusLabelAttribute(): string
    {
        return self::statuses()[$this->status] ?? $this->status;
    }

    // Relasi
    public function jobVacancy()
    {
        return $this->belongsTo(JobVacancy::class);
    }

    public function applicantBiodata()
    {
        return $this->belongsTo(ApplicantBiodata::class);
    }
}
