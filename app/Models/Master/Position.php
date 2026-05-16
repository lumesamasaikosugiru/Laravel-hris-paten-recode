<?php

namespace App\Models\Master;

use Illuminate\Database\Eloquent\Model;

class Position extends Model
{
    protected $fillable = ['school_id', 'name', 'description'];

    // Relasi
    public function school()
    {
        return $this->belongsTo(School::class);
    }

    public function positionAssignments()
    {
        return $this->hasMany(\App\Models\HR\PositionAssignment::class);
    }

    public function jobVacancies()
    {
        return $this->hasMany(\App\Models\Recruitment\JobVacancy::class);
    }
}
