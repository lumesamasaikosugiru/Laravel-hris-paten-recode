<?php

namespace App\Models\Recruitment;

use Illuminate\Database\Eloquent\Model;

class ApplicantBiodata extends Model
{
    protected $fillable = [
        'ktp',
        'fullname',
        'gender',
        'birthday',
        'birthplace',
        'address_street',
        'address_district',
        'address_city',
        'address_province',
        'marital_status',
        'religion',
        'ethnicity',
        'phone',
        'email',
        'photo_path',
    ];

    protected function casts(): array
    {
        return [
            'birthday' => 'date',
        ];
    }

    // Accessor: umur
    public function getAgeAttribute(): int
    {
        return $this->birthday->age;
    }

    // Accessor: alamat lengkap
    public function getFullAddressAttribute(): string
    {
        return implode(', ', array_filter([
            $this->address_street,
            $this->address_district,
            $this->address_city,
            $this->address_province,
        ]));
    }

    // Relasi
    public function educations()
    {
        return $this->hasMany(ApplicantEducation::class);
    }

    public function latestEducation()
    {
        return $this->hasOne(ApplicantEducation::class)
            ->where('is_latest', true);
    }

    public function experiences()
    {
        return $this->hasMany(ApplicantExperience::class);
    }

    public function skills()
    {
        return $this->hasMany(ApplicantSkill::class);
    }

    public function jobApplications()
    {
        return $this->hasMany(JobApplicant::class);
    }

    public function employee()
    {
        return $this->hasOne(\App\Models\HR\Employee::class);
    }
}
