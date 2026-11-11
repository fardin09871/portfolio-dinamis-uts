<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('about_profiles', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('full_name');
            $table->string('role');
            $table->string('profile_label')->default('DEVELOPER PROFILE');
            $table->string('image_path')->nullable();
            $table->string('quote')->nullable();
            $table->string('est_year')->default('2026');
            $table->string('universe_code')->default('EARTH - 001');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('about_profiles');
    }
};