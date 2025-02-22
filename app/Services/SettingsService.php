<?php

namespace App\Services;

use App\Repositories\SettingsRepository;

class SettingsService
{
    private SettingsRepository $settingsRepository;

    public function __construct()
    {
        $this->settingsRepository = new SettingsRepository();
    }

    public function getUserSettings(int $user_id, int $perPage)
    {
        return $this->settingsRepository->getUserSettings($user_id, $perPage);
    }

    public function changeUserSettings($validated)
    {
        //
    }
}
