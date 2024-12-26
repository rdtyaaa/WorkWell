<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PersonalData extends Model
{
    protected $table = 'personal_data'; // Jika nama tabel berbeda dengan nama model

    protected $fillable = [
        'user_id',
        'job_title',
        'company_name',
        'location',
        'start_date',
        'end_date',
        'is_working',
    ];

    protected $casts = [
        'start_date' => 'date',
        'end_date' => 'date',
        'is_working' => 'boolean',
    ];

    // Relasi ke User
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
