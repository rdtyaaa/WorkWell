<?php

namespace App\Models;

use App\Models\User;
use App\Models\JobVacancy;
use App\Models\PersonalData;
use Illuminate\Database\Eloquent\Model;

class Application extends Model
{
    protected $fillable = [
        'user_id',
        'job_id',
        'cv',
        'status',
        'supporting_documents',
    ];

    // Relasi ke User
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relasi ke Job
    public function job()
    {
        return $this->belongsTo(JobVacancy::class, 'job_id');
    }

    // Relasi ke PersonalData
    public function personalData()
    {
        return $this->hasOne(PersonalData::class, 'user_id', 'user_id');
    }
}
