<?php

use App\Enums\MethodsEnum;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('setting_change_requests', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users');
            $table->foreignId('setting_id')->constrained('settings');
            $table->enum('method', array_column(MethodsEnum::cases(), 'value'));
            $table->string('old_value');
            $table->string('new_value');
            $table->string('verification_code');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('setting_change_requests');
    }
};
