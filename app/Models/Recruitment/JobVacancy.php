<?php

namespace App\Models\Recruitment;

use App\Models\Master\Department;
use App\Models\Master\EmployeeCategory;
use App\Models\Master\Position;
use App\Models\Master\School;
use Illuminate\Database\Eloquent\Model;

class JobVacancy extends Model
{
    protected $fillable = [
        'school_id',
        'department_id',
        'position_id',
        'employee_category_id',
        'title',
        'description',
        'quota',
        'open_date',
        'close_date',
        'is_active',
    ];

    protected function casts(): array
    {
        return [
            'open_date' => 'date',
            'close_date' => 'date',
            'is_active' => 'boolean',
            'quota' => 'integer',
        ];
    }

    // Scope
    public function scopeActive($query)
    {
        return $query->where('is_active', true)
            ->where(function ($q) {
                $q->whereNull('close_date')
                    ->orWhere('close_date', '>=', now()->toDateString());
            });
    }

    // Accessor: sisa quota
    public function getRemainingQuotaAttribute(): int
    {
        return $this->quota - $this->jobApplicants()
            ->where('status', 'accepted')
            ->count();
    }

    // Relasi
    public function school()
    {
        return $this->belongsTo(School::class);
    }

    public function department()
    {
        return $this->belongsTo(Department::class);
    }

    public function position()
    {
        return $this->belongsTo(Position::class);
    }

    public function employeeCategory()
    {
        return $this->belongsTo(EmployeeCategory::class);
    }

    public function jobApplicants()
    {
        return $this->hasMany(JobApplicant::class);
    }
}
