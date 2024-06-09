<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Symfony\Component\Mailer\Transport\Transports;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Company extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    /**
     * Get all of the comments for the Company
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function transport(): HasMany
    {
        return $this->hasMany(Transports::class);
    }
}
