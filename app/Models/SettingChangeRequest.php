<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class SettingChangeRequest extends Model
{
    protected $fillable = [
        'user_id',
        'setting_id',
        'method',
        'old_value',
        'new_value',
        'verification_code',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function setting(): BelongsTo
    {
        return $this->belongsTo(Setting::class);
    }
}
