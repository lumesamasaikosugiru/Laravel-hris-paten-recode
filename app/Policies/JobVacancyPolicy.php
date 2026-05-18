<?php

namespace App\Policies;

use App\Models\Recruitment\JobVacancy;
use App\Models\User;
use App\Traits\HasSchoolScope;

class JobVacancyPolicy
{
    use HasSchoolScope;

    public function viewAny(User $user): bool
    {
        return $user->hasPermissionTo('recruitment.view');
    }

    public function view(User $user, JobVacancy $jobVacancy): bool
    {
        if ($user->hasRole('kepala_sekolah')) {
            return $this->canAccessSchool($user, $jobVacancy->school_id);
        }

        return $user->hasPermissionTo('recruitment.view');
    }

    public function create(User $user): bool
    {
        return $user->hasPermissionTo('recruitment.create');
    }

    public function update(User $user, JobVacancy $jobVacancy): bool
    {
        return $user->hasPermissionTo('recruitment.edit')
            && $this->canAccessSchool($user, $jobVacancy->school_id);
    }

    public function delete(User $user, JobVacancy $jobVacancy): bool
    {
        return $user->hasPermissionTo('recruitment.delete')
            && $this->canAccessSchool($user, $jobVacancy->school_id);
    }
}