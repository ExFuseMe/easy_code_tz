<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class SettingChangeRequest extends Model
{
    use SoftDeletes;
    protected $fillable = [
        'user_id',
        'setting_id',
        'method',
        'old_value',
        'new_value',
        'verification_code',
        'is_verified',
        'expired_at'
    ];

    protected $casts = [
        'expired_at' => 'datetime',
    ];
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function setting(): BelongsTo
    {
        return $this->belongsTo(Setting::class);
    }

    protected static function booted()
    {
        parent::booted();

        static::creating(function ($model) {
            SettingChangeRequest::where('setting_id', $model->setting_id)->delete();
        });
    }
}
