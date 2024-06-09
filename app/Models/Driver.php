<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Driver extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    /**
     * Get all of the comments for the Driver
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function lending(): HasMany
    {
        return $this->hasMany(Lending::class);
    }
}