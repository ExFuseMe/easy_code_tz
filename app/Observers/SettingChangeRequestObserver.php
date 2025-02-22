<?php

namespace App\Observers;

use App\Models\SettingChangeRequest;

class SettingChangeRequestObserver
{
    public function onCodeVerified(SettingChangeRequest $request) {
        // Логика обработки после успешной верификации кода, например, новое письмо или push увед-ние
    }
}
