<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Setting extends Model
{
    protected $fillable = ['key', 'value', 'confirmed'];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function changeRequest(): HasMany
    {
        return $this->hasMany(SettingChangeRequest::class);
    }
}
