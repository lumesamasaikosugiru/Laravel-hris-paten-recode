<?php

namespace App\Models\Master;

use Illuminate\Database\Eloquent\Model;

class LeaveType extends Model
{
    protected $fillable = [
        'name',
        'default_days',
        'is_paid',
        'requires_approval',
        'description',
    ];

    protected function casts(): array
    {
        return [
            'default_days' => 'integer',
            'is_paid' => 'boolean',
            'requires_approval' => 'boolean',
        ];
    }

    public function leaveRequests()
    {
        return $this->hasMany(\App\Models\Operational\LeaveRequest::class);
    }

    public function leaveBalances()
    {
        return $this->hasMany(\App\Models\Operational\LeaveBalance::class);
    }
}
