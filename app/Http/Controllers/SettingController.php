<?php

namespace App\Http\Controllers;

use App\Actions\SettingAction;
use App\Http\Requests\ConfirmSettingsRequest;
use App\Http\Requests\UpdateSettingRequest;
use App\Models\Setting;

class SettingController extends Controller
{
    private SettingAction $action;

    public function __construct()
    {
        $this->action = new SettingAction();
    }

    public function update(UpdateSettingRequest $request, Setting $setting)
    {
        $this->authorize('update', $setting);
        $validated = $request->validated();
        $code = $this->action->change($setting, $validated);
        return response()->json(['message' => 'Подтвердите изменение настройки', 'код для тестирования' => $code]);
    }

    public function confirmChange(ConfirmSettingsRequest $request, Setting $setting)
    {
        $this->authorize('update', $setting);
        $validated = $request->validated();

        $response = $this->action->confirm($setting, $validated);

        return $response;
    }
}
