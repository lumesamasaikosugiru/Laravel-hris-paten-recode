<?php

namespace App\Models\History;

use App\Models\HR\Employee;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;

class EmployeeStatusHistory extends Model
{
    protected $fillable = [
        'employee_id',
        'status_from',
        'status_to',
        'effective_date',
        'changed_by',
        'notes',
    ];

    protected function casts(): array
    {
        return [
            'effective_date' => 'date',
        ];
    }

    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }

    public function changedBy()
    {
        return $this->belongsTo(User::class, 'changed_by');
    }
}
