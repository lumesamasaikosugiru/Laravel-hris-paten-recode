<?php

namespace App\Models\Master;

use App\Models\HR\Employee;
use App\Models\Recruitment\ApplicantEducation;
use Illuminate\Database\Eloquent\Model;

class EducationLevel extends Model
{
    protected $fillable = ['code', 'name', 'sort_order'];

    protected function casts(): array
    {
        return [
            'sort_order' => 'integer',
        ];
    }

    // Scope: urutan tampil
    public function scopeOrdered($query)
    {
        return $query->orderBy('sort_order')->orderBy('name');
    }

    // Relasi
    public function employees()
    {
        return $this->hasMany(Employee::class);
    }

    public function applicantEducations()
    {
        return $this->hasMany(ApplicantEducation::class);
    }
}
