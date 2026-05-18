<?php

namespace App\Policies;

use App\Models\Operational\Attendance;
use App\Models\User;
use App\Traits\HasSchoolScope;

class AttendancePolicy
{
    use HasSchoolScope;

    public function viewAny(User $user): bool
    {
        return $user->hasAnyPermission([
            'attendance.view',
            'attendance.view_own',
        ]);
    }

    public function view(User $user, Attendance $attendance): bool
    {
        if ($user->hasRole('employee')) {
            return $user->employee?->id === $attendance->employee_id;
        }

        if ($user->hasRole('kepala_sekolah')) {
            return $this->canAccessSchool($user, $attendance->school_id);
        }

        return $user->hasPermissionTo('attendance.view');
    }

    public function create(User $user): bool
    {
        return $user->hasPermissionTo('attendance.create');
    }

    public function update(User $user, Attendance $attendance): bool
    {
        // Employee tidak boleh edit absensinya sendiri via resource
        if ($user->hasRole('employee')) {
            return false;
        }

        if ($user->hasRole('kepala_sekolah')) {
            return false; // kepala sekolah read-only
        }

        return $user->hasPermissionTo('attendance.edit')
            && $this->canAccessSchool($user, $attendance->school_id);
    }

    public function delete(User $user, Attendance $attendance): bool
    {
        return $user->hasRole('super_admin');
    }
}