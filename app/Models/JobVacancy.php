<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\Company;
use App\Models\Application;
use Illuminate\Database\Eloquent\Model;

class JobVacancy extends Model
{

    use HasFactory;

    protected $fillable = ['position', 'description', 'qualifications', 'salary', 'location', 'company_id'];

    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    public function applications()
    {
        return $this->hasMany(Application::class, 'job_id');
    }
}
