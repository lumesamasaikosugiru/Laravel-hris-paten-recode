<?php

namespace App\Models\HR;

use App\Models\Master\Department;
use App\Models\Master\Position;
use App\Models\Master\School;
use Illuminate\Database\Eloquent\Model;

class PositionAssignment extends Model
{
    protected $fillable = [
        'employee_id',
        'school_id',
        'department_id',
        'position_id',
        'start_date',
        'end_date',
        'is_active',
    ];

    protected function casts(): array
    {
        return [
            'start_date' => 'date',
            'end_date' => 'date',
            'is_active' => 'boolean',
        ];
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }

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
}
