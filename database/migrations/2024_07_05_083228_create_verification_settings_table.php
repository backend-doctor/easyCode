<?php

use App\Enum\VerificationMethod;
use App\Models\User;
use App\Models\UserSetting;
use App\Models\VerificationSetting;
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
        Schema::create('verification_settings', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(UserSetting::class);
            $table->string('code');
            $table->enum('method', VerificationSetting::getMethods());
            $table->string('value');
            $table->integer('expires_at');
            $table->boolean('used')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('verification_settings');
    }
};
