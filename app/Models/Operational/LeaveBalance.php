<?php

namespace App\Models\Operational;

use App\Models\HR\Employee;
use App\Models\Master\LeaveType;
use Illuminate\Database\Eloquent\Model;

class LeaveBalance extends Model
{
    protected $fillable = [
        'employee_id',
        'leave_type_id',
        'year',
        'allocated_days',
        'used_days',
        'remaining_days',
    ];

    protected function casts(): array
    {
        return [
            'year' => 'integer',
            'allocated_days' => 'integer',
            'used_days' => 'integer',
            'remaining_days' => 'integer',
        ];
    }

    // Scope: tahun berjalan
    public function scopeCurrentYear($query)
    {
        return $query->where('year', now()->year);
    }

    // Scope: cari balance spesifik
    public function scopeForLeaveType($query, int $leaveTypeId)
    {
        return $query->where('leave_type_id', $leaveTypeId);
    }

    // Relasi
    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }

    public function leaveType()
    {
        return $this->belongsTo(LeaveType::class);
    }
}
