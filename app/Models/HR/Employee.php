<?php

namespace App\Models\HR;

use App\Models\Master\EducationLevel;
use App\Models\Master\EmployeeCategory;
use App\Models\Master\School;
use App\Models\Recruitment\ApplicantBiodata;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Employee extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'applicant_biodata_id',
        'user_id',
        'school_id',
        'employee_category_id',
        'education_level_id',
        'full_name',
        'ktp',
        'gender',
        'birthplace',
        'birthday',
        'marital_status',
        'religion',
        'address',
        'phone',
        'email',
        'photo_path',
        'join_date',
        'status',
        'nipy',
        'nipy_generated_at',
        'probation_end_date',
    ];

    protected function casts(): array
    {
        return [
            'birthday' => 'date',
            'join_date' => 'date',
            'probation_end_date' => 'date',
            'nipy_generated_at' => 'datetime',
        ];
    }

    // Status constants
    const STATUS_PROBATION = 'probation';
    const STATUS_ACTIVE = 'active';
    const STATUS_INACTIVE = 'inactive';
    const STATUS_RESIGNED = 'resigned';
    const STATUS_TERMINATED = 'terminated';

    public static function statuses(): array
    {
        return [
            self::STATUS_PROBATION => 'Probation',
            self::STATUS_ACTIVE => 'Aktif',
            self::STATUS_INACTIVE => 'Tidak Aktif',
            self::STATUS_RESIGNED => 'Resign',
            self::STATUS_TERMINATED => 'Diberhentikan',
        ];
    }

    // === SCOPES ===

    public function scopeActive($query)
    {
        return $query->where('status', self::STATUS_ACTIVE);
    }

    public function scopeProbation($query)
    {
        return $query->where('status', self::STATUS_PROBATION);
    }

    // Eligible untuk generate NIPY
    public function scopeNipyEligible($query)
    {
        return $query->where('status', self::STATUS_ACTIVE)
            ->whereNull('nipy')
            ->whereDate('probation_end_date', '<=', now()->toDateString());
    }

    // Filter per sekolah
    public function scopeForSchool($query, int $schoolId)
    {
        return $query->where('school_id', $schoolId);
    }

    // === ACCESSORS ===

    public function getAgeAttribute(): int
    {
        return $this->birthday->age;
    }

    public function getStatusLabelAttribute(): string
    {
        return self::statuses()[$this->status] ?? $this->status;
    }

    public function getHasNipyAttribute(): bool
    {
        return !is_null($this->nipy);
    }

    // Apakah masih dalam masa probation
    public function getIsOnProbationAttribute(): bool
    {
        return $this->probation_end_date->isFuture();
    }

    // === RELASI ===

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function school()
    {
        return $this->belongsTo(School::class);
    }

    public function employeeCategory()
    {
        return $this->belongsTo(EmployeeCategory::class);
    }

    public function educationLevel()
    {
        return $this->belongsTo(EducationLevel::class);
    }

    public function applicantBiodata()
    {
        return $this->belongsTo(ApplicantBiodata::class);
    }

    // Posisi aktif saat ini
    public function currentPosition()
    {
        return $this->hasOne(PositionAssignment::class)
            ->where('is_active', true)
            ->latestOfMany('start_date');
    }

    public function positionAssignments()
    {
        return $this->hasMany(PositionAssignment::class);
    }

    public function statusHistories()
    {
        return $this->hasMany(\App\Models\History\EmployeeStatusHistory::class);
    }

    public function schoolHistories()
    {
        return $this->hasMany(\App\Models\History\EmployeeSchoolHistory::class);
    }

    public function attendances()
    {
        return $this->hasMany(\App\Models\Operational\Attendance::class);
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
