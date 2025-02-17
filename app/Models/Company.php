<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Company extends Model
{
    protected $fillable = [
        'name',
        'email',
        'logo',
        'address',
    ];

    public function employees(): BelongsTo
    {
        return $this->belongsTo(Employee::class);
    }

}
