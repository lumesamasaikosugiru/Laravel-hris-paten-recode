<?php

namespace App\Providers;

use App\Models\HR\Employee;
use App\Models\Master\Department;
use App\Models\Master\EducationLevel;
use App\Models\Master\EmployeeCategory;
use App\Models\Master\LeaveType;
use App\Models\Master\Position;
use App\Models\Master\School;
use App\Models\Master\Skill;
use App\Models\Operational\Attendance;
use App\Models\Operational\LeaveRequest;
use App\Models\Recruitment\JobApplicant;
use App\Models\Recruitment\JobVacancy;
use App\Models\User;
use App\Policies\AttendancePolicy;
use App\Policies\EmployeePolicy;
use App\Policies\JobApplicantPolicy;
use App\Policies\JobVacancyPolicy;
use App\Policies\LeaveRequestPolicy;
use App\Policies\MasterDataPolicy;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        $this->registerPolicies();
        $this->registerGates();
    }

    private function registerPolicies(): void
    {
        // HR Core
        Gate::policy(Employee::class, EmployeePolicy::class);

        // Operasional
        Gate::policy(LeaveRequest::class, LeaveRequestPolicy::class);
        Gate::policy(Attendance::class, AttendancePolicy::class);

        // Recruitment
        Gate::policy(JobVacancy::class, JobVacancyPolicy::class);
        Gate::policy(JobApplicant::class, JobApplicantPolicy::class);

        // Master Data — semua model master pakai satu policy
        foreach ([
            School::class,
            Department::class,
            Position::class,
            EducationLevel::class,
            EmployeeCategory::class,
            Skill::class,
            LeaveType::class,
        ] as $model) {
            Gate::policy($model, MasterDataPolicy::class);
        }
    }

    private function registerGates(): void
    {
        // Super admin bypass semua gate
        // WAJIB: harus di-define sebelum policy lain
        Gate::before(function (User $user, string $ability) {
            if ($user->hasRole('super_admin')) {
                return true;
            }
        });
    }
}