<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CertificateType extends Model
{
    protected $fillable = [
        'name',
        'description',
        'fee',
        'requirements',
        'is_active',
    ];

    protected $casts = [
        'requirements' => 'array',
        'is_active' => 'boolean',
        'fee' => 'decimal:2',
    ];

    public function certificateRequests()
    {
        return $this->hasMany(CertificateRequest::class);
    }
}
