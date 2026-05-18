<?php

namespace App\Policies;

use App\Models\Recruitment\JobApplicant;
use App\Models\User;
use App\Traits\HasSchoolScope;

class JobApplicantPolicy
{
    use HasSchoolScope;

    public function viewAny(User $user): bool
    {
        return $user->hasPermissionTo('recruitment.view');
    }

    public function view(User $user, JobApplicant $jobApplicant): bool
    {
        if ($user->hasRole('kepala_sekolah')) {
            return $this->canAccessSchool(
                $user,
                $jobApplicant->jobVacancy->school_id
            );
        }

        return $user->hasPermissionTo('recruitment.view');
    }

    public function create(User $user): bool
    {
        return $user->hasPermissionTo('recruitment.create');
    }

    public function update(User $user, JobApplicant $jobApplicant): bool
    {
        return $user->hasPermissionTo('recruitment.edit')
            && $this->canAccessSchool(
                $user,
                $jobApplicant->jobVacancy->school_id
            );
    }

    public function delete(User $user, JobApplicant $jobApplicant): bool
    {
        return $user->hasPermissionTo('recruitment.delete');
    }

    /**
     * Custom policy: apakah boleh proses (screening/interview/accept/reject)?
     */
    public function process(User $user, JobApplicant $jobApplicant): bool
    {
        return $user->hasPermissionTo('recruitment.process')
            && $this->canAccessSchool(
                $user,
                $jobApplicant->jobVacancy->school_id
            );
    }
}