<?php

namespace App\Policies;

use App\Models\HR\Employee;
use App\Models\User;
use App\Traits\HasSchoolScope;

class EmployeePolicy
{
    use HasSchoolScope;

    /**
     * Apakah user boleh mengakses menu Employee sama sekali?
     */
    public function viewAny(User $user): bool
    {
        return $user->hasAnyPermission([
            'employee.view',
            'employee.view_own',
        ]);
    }

    /**
     * Apakah user boleh melihat detail employee tertentu?
     */
    public function view(User $user, Employee $employee): bool
    {
        // Employee hanya boleh lihat data dirinya sendiri
        if ($user->hasRole('employee')) {
            return $user->employee?->id === $employee->id;
        }

        // Kepala sekolah hanya boleh lihat pegawai di sekolahnya
        if ($user->hasRole('kepala_sekolah')) {
            return $this->canAccessSchool($user, $employee->school_id);
        }

        return $user->hasPermissionTo('employee.view');
    }

    public function create(User $user): bool
    {
        return $user->hasPermissionTo('employee.create');
    }

    public function update(User $user, Employee $employee): bool
    {
        // Employee tidak boleh edit data siapapun via resource
        if ($user->hasRole('employee')) {
            return false;
        }

        if ($user->hasRole('kepala_sekolah')) {
            return false; // kepala sekolah read-only untuk employee
        }

        return $user->hasPermissionTo('employee.edit')
            && $this->canAccessSchool($user, $employee->school_id);
    }

    public function delete(User $user, Employee $employee): bool
    {
        return $user->hasPermissionTo('employee.delete')
            && $this->canAccessSchool($user, $employee->school_id);
    }

    public function restore(User $user, Employee $employee): bool
    {
        return $user->hasPermissionTo('employee.delete');
    }

    public function forceDelete(User $user, Employee $employee): bool
    {
        return $user->hasRole('super_admin');
    }
}