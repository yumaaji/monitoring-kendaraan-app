<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Lending extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    /**
     * Get the user that owns the Lending
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function transport(): BelongsTo
    {
        return $this->belongsTo(Transportation::class);
    }

    /**
     * Get the user that owns the Lending
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function supervisor(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the user that owns the Lending
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function company(): BelongsTo
    {
        return $this->belongsTo(Company::class);
    }

    /**
     * Get the user that owns the Lending
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function driver(): BelongsTo
    {
        return $this->belongsTo(Driver::class);
    }
}
