<?php

namespace App\Models\Recruitment;

use App\Models\Master\EducationLevel;
use Illuminate\Database\Eloquent\Model;

class ApplicantEducation extends Model
{
    protected $fillable = [
        'applicant_biodata_id',
        'education_level_id',
        'institution',
        'major',
        'graduation_year',
        'is_latest',
    ];

    protected function casts(): array
    {
        return [
            'is_latest' => 'boolean',
            'graduation_year' => 'integer',
        ];
    }

    public function applicantBiodata()
    {
        return $this->belongsTo(ApplicantBiodata::class);
    }

    public function educationLevel()
    {
        return $this->belongsTo(EducationLevel::class);
    }
}
