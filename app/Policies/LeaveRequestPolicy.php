<?php

namespace App\Policies;

use App\Models\Operational\LeaveRequest;
use App\Models\User;
use App\Traits\HasSchoolScope;

class LeaveRequestPolicy
{
    use HasSchoolScope;

    public function viewAny(User $user): bool
    {
        return $user->hasAnyPermission([
            'leave.view',
            'leave.view_own',
        ]);
    }

    public function view(User $user, LeaveRequest $leaveRequest): bool
    {
        // Employee hanya boleh lihat pengajuan cuti miliknya
        if ($user->hasRole('employee')) {
            return $user->employee?->id === $leaveRequest->employee_id;
        }

        // Kepala sekolah hanya boleh lihat cuti di sekolahnya
        if ($user->hasRole('kepala_sekolah')) {
            return $this->canAccessSchool($user, $leaveRequest->school_id);
        }

        return $user->hasPermissionTo('leave.view');
    }

    public function create(User $user): bool
    {
        return $user->hasAnyPermission([
            'leave.create',
            'leave.request_own',
        ]);
    }

    public function update(User $user, LeaveRequest $leaveRequest): bool
    {
        // Employee hanya boleh edit jika masih pending dan miliknya
        if ($user->hasRole('employee')) {
            return $user->employee?->id === $leaveRequest->employee_id
                && $leaveRequest->status === LeaveRequest::STATUS_PENDING;
        }

        if ($user->hasRole('kepala_sekolah')) {
            return false; // kepala sekolah tidak edit, hanya approve
        }

        return $user->hasPermissionTo('leave.create')
            && $this->canAccessSchool($user, $leaveRequest->school_id);
    }

    public function delete(User $user, LeaveRequest $leaveRequest): bool
    {
        // Hanya boleh hapus jika masih pending
        if ($leaveRequest->status !== LeaveRequest::STATUS_PENDING) {
            return false;
        }

        if ($user->hasRole('employee')) {
            return $user->employee?->id === $leaveRequest->employee_id;
        }

        return $user->hasPermissionTo('leave.create')
            && $this->canAccessSchool($user, $leaveRequest->school_id);
    }

    /**
     * Custom policy: apakah boleh approve/reject?
     */
    public function approve(User $user, LeaveRequest $leaveRequest): bool
    {
        if (!$user->hasPermissionTo('leave.approve')) {
            return false;
        }

        // Tidak bisa approve pengajuan sendiri
        if ($user->employee?->id === $leaveRequest->employee_id) {
            return false;
        }

        return $this->canAccessSchool($user, $leaveRequest->school_id);
    }

    public function reject(User $user, LeaveRequest $leaveRequest): bool
    {
        if (!$user->hasPermissionTo('leave.reject')) {
            return false;
        }

        if ($user->employee?->id === $leaveRequest->employee_id) {
            return false;
        }

        return $this->canAccessSchool($user, $leaveRequest->school_id);
    }
}