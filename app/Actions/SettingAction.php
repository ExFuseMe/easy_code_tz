<?php

namespace App\Actions;

use App\Factories\VerificationMethodFactory;
use App\Jobs\ExpireSettingChangeRequestJob;
use App\Models\Setting;
use App\Models\SettingChangeRequest;
use Carbon\Carbon;
use Illuminate\Http\JsonResponse;

class SettingAction
{
    public function change(Setting $setting, array $validated): int
    {
        $verificationMethod = VerificationMethodFactory::create($validated['verification_method']);
        $code = $verificationMethod->sendVerificationCode();
        $expireTime = Carbon::now()->addSeconds(20);
        $changeRequest = SettingChangeRequest::create([
            'user_id' => auth()->id(),
            'setting_id' => $setting->id,
            'old_value' => $setting->value,
            'new_value' => $validated['new_value'],
            'verification_code' => $code,
            'method' => $validated['verification_method'],
            'expired_at' => $expireTime,
        ]);
        ExpireSettingChangeRequestJob::dispatch($changeRequest)->delay($expireTime);
        return $code;
    }

    public function confirm(Setting $setting, array $validated): JsonResponse
    {
        $changeRequest = $setting->changeRequest()->where('is_verified', false)->first();

        if (is_null($changeRequest)) {
            return response()->json(['message' => 'Запрос на изменение не найден'], 404);
        }

        if ($changeRequest->verification_code == $validated['verification_code']) {
            $setting->update(['value' => $changeRequest->new_value]);
            $changeRequest->update(['is_verified' => true]);
            return response()->json(['message' => 'Настройка успешно изменена']);
        }

        return response()->json(['message' => 'Неверный код подтверждения'], 400);
    }
}
