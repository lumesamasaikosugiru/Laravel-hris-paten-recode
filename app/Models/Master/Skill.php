<?php

namespace App\Models\Master;

use Illuminate\Database\Eloquent\Model;

class Skill extends Model
{
    protected $fillable = ['name', 'description'];

    public function applicantSkills()
    {
        return $this->hasMany(\App\Models\Recruitment\ApplicantSkill::class);
    }
}
