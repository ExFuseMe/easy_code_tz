<?php

namespace App\Jobs;

use App\Models\SettingChangeRequest;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class ExpireSettingChangeRequestJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private SettingChangeRequest $settingChangeRequest;

    public function __construct(SettingChangeRequest $settingChangeRequest)
    {
        $this->settingChangeRequest = $settingChangeRequest;
    }

    public function handle(): void
    {
        if (!$this->settingChangeRequest->is_verified) {
            $this->settingChangeRequest->delete();
        }
    }
}
