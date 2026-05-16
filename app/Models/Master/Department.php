<?php

namespace App\Models\Master;

use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    protected $fillable = ['school_id', 'name', 'description'];

    // Relasi
    public function school()
    {
        return $this->belongsTo(School::class);
    }

    public function positions()
    {
        return $this->hasMany(Position::class);
    }

    public function positionAssignments()
    {
        return $this->hasMany(\App\Models\HR\PositionAssignment::class);
    }
}
