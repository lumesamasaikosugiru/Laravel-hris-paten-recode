<?php

namespace App\Traits;

use App\Models\User;

trait HasSchoolScope
{
    /**
     * Ambil school_id yang boleh diakses user.
     * - super_admin & hr_admin : null (semua sekolah)
     * - kepala_sekolah         : hanya sekolah yang dia pimpin
     * - employee               : hanya sekolah tempat dia bekerja
     */
    protected function getAccessibleSchoolIds(User $user): ?array
    {
        if ($user->hasAnyRole(['super_admin', 'hr_admin'])) {
            return null; // null = tidak ada pembatasan
        }

        if ($user->hasRole('kepala_sekolah')) {
            // Kepala sekolah diasosiasikan via employee → school_id
            $schoolId = $user->employee?->school_id;
            return $schoolId ? [$schoolId] : [];
        }

        if ($user->hasRole('employee')) {
            $schoolId = $user->employee?->school_id;
            return $schoolId ? [$schoolId] : [];
        }

        return []; // role tidak dikenal = tidak ada akses
    }

    /**
     * Cek apakah user boleh mengakses resource di school_id tertentu.
     */
    protected function canAccessSchool(User $user, int $schoolId): bool
    {
        $accessible = $this->getAccessibleSchoolIds($user);

        if ($accessible === null) {
            return true; // super_admin / hr_admin: akses semua
        }

        return in_array($schoolId, $accessible);
    }
}