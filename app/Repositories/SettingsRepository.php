<?php

namespace App\Repositories;

use App\Models\Setting as Model;
class SettingsRepository extends coreRepository
{
    public function getModelClass(): string
    {
        return Model::class;
    }

    public function getUserSettings(int $user_id, int $perPage)
    {
        $result = $this->startConditions()
            ->where('user_id', $user_id)
            ->paginate($perPage);
        return $result;
    }
}
