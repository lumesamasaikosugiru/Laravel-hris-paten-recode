<?php

namespace App\Models\Master;

use Illuminate\Database\Eloquent\Model;

class EmployeeCategory extends Model
{
    protected $fillable = ['code', 'name', 'probation_months'];

    protected function casts(): array
    {
        return [
            'code' => 'integer',
            'probation_months' => 'integer',
        ];
    }

    // Scope: hanya guru (kode 1x)
    public function scopeGuru($query)
    {
        return $query->whereBetween('code', [10, 19]);
    }

    // Scope: hanya tendik (kode 2x)
    public function scopeTendik($query)
    {
        return $query->whereBetween('code', [20, 29]);
    }

    // Accessor: apakah kategori ini punya masa probation?
    public function getHasProbationAttribute(): bool
    {
        return $this->probation_months > 0;
    }

    // Relasi
    public function employees()
    {
        return $this->hasMany(\App\Models\HR\Employee::class);
    }

    public function jobVacancies()
    {
        return $this->hasMany(\App\Models\Recruitment\JobVacancy::class);
    }
}
