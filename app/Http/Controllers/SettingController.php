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


    /**
     * @OA\Post (
     *     path="/api/settings/{setting}",
     *     summary="Создание нового запроса на обновление настроек",
     *     tags={"Settings"},
     *     security={{ "bearerAuth":{} }},
     *     @OA\Parameter (
     *          name="setting",
     *          in="path",
     *          required=true,
     *       ),
     *     @OA\RequestBody(
     *          required=true,
     *          @OA\MediaType(
     *               mediaType="multipart/form-data",
     *               @OA\Schema(ref="#/components/schemas/UpdateSettingRequest",),
     *          ),
     *     ),
     *     @OA\Response(
     *          response="200",
     *          description="Успешно",
     *     ),
     * )
     */
    public function update(UpdateSettingRequest $request, Setting $setting)
    {
        $this->authorize('update', $setting);
        $validated = $request->validated();
        $code = $this->action->change($setting, $validated);
        return response()->json(['message' => 'Подтвердите изменение настройки', 'код для тестирования' => $code]);
    }


    /**
     * @OA\Post (
     *     path="/api/settings/{setting}/confirm",
     *     summary="Подтверждение запроса на обновление настроек",
     *     tags={"Settings"},
     *     security={{ "bearerAuth":{} }},
     *     @OA\Parameter (
     *          name="setting",
     *          in="path",
     *          required=true,
     *       ),
     *     @OA\RequestBody(
     *          required=true,
     *          @OA\MediaType(
     *               mediaType="multipart/form-data",
     *               @OA\Schema(ref="#/components/schemas/ConfirmSettingRequest",),
     *          ),
     *     ),
     *     @OA\Response(
     *          response="200",
     *          description="Успешно",
     *     ),
     * )
     */
    public function confirmChange(ConfirmSettingsRequest $request, Setting $setting)
    {
        $this->authorize('update', $setting);
        $validated = $request->validated();

        $response = $this->action->confirm($setting, $validated);

        return $response;
    }
}
