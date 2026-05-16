<?php

namespace App\Models\Operational;

use App\Models\HR\Employee;
use App\Models\Master\School;
use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{
    protected $fillable = [
        'employee_id',
        'school_id',
        'date',
        'check_in_at',
        'check_out_at',
        'late_minutes',
        'work_minutes',
        'status',
        'check_in_method',
        'notes',
    ];

    protected function casts(): array
    {
        return [
            'date' => 'date',
            'check_in_at' => 'datetime',
            'check_out_at' => 'datetime',
            'late_minutes' => 'integer',
            'work_minutes' => 'integer',
        ];
    }

    // Accessor: jam kerja dalam format HH:MM
    public function getWorkHoursFormattedAttribute(): string
    {
        $hours = intdiv($this->work_minutes, 60);
        $minutes = $this->work_minutes % 60;
        return sprintf('%02d:%02d', $hours, $minutes);
    }

    // Accessor: apakah terlambat
    public function getIsLateAttribute(): bool
    {
        return $this->late_minutes > 0;
    }

    // Scope
    public function scopePresent($query)
    {
        return $query->where('status', 'present');
    }

    public function scopeForMonth($query, int $year, int $month)
    {
        return $query->whereYear('date', $year)->whereMonth('date', $month);
    }

    // Relasi
    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }

    public function school()
    {
        return $this->belongsTo(School::class);
    }
}
