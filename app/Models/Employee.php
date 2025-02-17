<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Employee extends Model
{
    protected $fillable = [
        'name',
        'email',
        'phone',
        'company_id',
    ];

    public function company(): HasOne
    {
        return $this->hasOne(Company::class);
    }
}
