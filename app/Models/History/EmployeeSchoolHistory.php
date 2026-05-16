<?php

namespace App\Models\History;

use App\Models\HR\Employee;
use App\Models\Master\School;
use Illuminate\Database\Eloquent\Model;

class EmployeeSchoolHistory extends Model
{
    protected $fillable = [
        'employee_id',
        'school_id',
        'start_date',
        'end_date',
        'contract_number',
        'description',
    ];

    protected function casts(): array
    {
        return [
            'start_date' => 'date',
            'end_date' => 'date',
        ];
    }

    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }

    public function school()
    {
        return $this->belongsTo(School::class);
    }
}
