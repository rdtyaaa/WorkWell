<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;

class Company extends Model
{

    protected $fillable = [
        'name',
        'address',
        'description',
        'user_id',
        'status', // pending, approved, rejected
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
