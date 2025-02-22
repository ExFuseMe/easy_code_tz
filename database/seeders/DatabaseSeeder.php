<?php

namespace Database\Seeders;

use App\Models\Setting;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
            'telegram_id' => fake()->unique()->randomNumber(9)
        ]);
        $settingsArray = [
            'bg' => 'white',
            'text-color' => 'black',
            'font-size' => '16',
        ];
        foreach ($settingsArray as $name => $value) {
            Setting::create(['key' => $name, 'value' => $value, 'user_id' => 1]);
        }
    }
}
