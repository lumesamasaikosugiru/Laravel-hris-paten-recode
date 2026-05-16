<?php

namespace App\Models\Master;

use Illuminate\Database\Eloquent\Model;

class School extends Model
{
    protected $fillable = [
        'name',
        'level_code',
        'npsn',
        'address',
        'phone',
        'email',
        'is_active',
    ];

    protected function casts(): array
    {
        return [
            'is_active' => 'boolean',
        ];
    }

    // Scope
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    // Relasi
    public function departments()
    {
        return $this->hasMany(Department::class);
    }

    public function positions()
    {
        return $this->hasMany(Position::class);
    }

    public function employees()
    {
        return $this->hasMany(\App\Models\HR\Employee::class);
    }

    public function jobVacancies()
    {
        return $this->hasMany(\App\Models\Recruitment\JobVacancy::class);
    }

    public function attendances()
    {
        return $this->hasMany(\App\Models\Operational\Attendance::class);
    }
}
