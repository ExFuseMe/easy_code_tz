<?php

namespace App\Policies;

use App\Models\Setting;
use App\Models\User;

class SettingsPolicy
{
    public function update(User $user, Setting $setting): bool
    {
        return $setting->user_id == $user->id;
    }
}
