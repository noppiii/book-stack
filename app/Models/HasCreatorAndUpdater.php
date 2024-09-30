<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;

trait HasCreatorAndUpdater
{
    public function createdBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function updatedBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'updated_by');
    }
}
