<?php

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
        Schema::create('settings', function (Blueprint $table) {
        $table->id();
        // Informasi Perusahaan
        $table->string('company_name')->default('Meity Travel');
        $table->string('tagline')->default('Jelajahi Keindahan Indonesia Bersama Kami');
        $table->string('logo_url')->nullable();
        $table->string('email')->nullable();
        $table->string('phone')->nullable();
        $table->string('whatsapp')->nullable();
        $table->string('website')->nullable();
        $table->text('address')->nullable();

        // Media Sosial
        $table->string('social_facebook')->nullable();
        $table->string('social_instagram')->nullable();
        $table->string('social_twitter')->nullable();
        $table->string('social_youtube')->nullable();

        // Notifikasi Email
        $table->boolean('notification_booking')->default(true);
        $table->boolean('notification_payment')->default(true);
        $table->boolean('notification_newsletter')->default(true);
        $table->boolean('notification_promo')->default(true);

        $table->timestamps();
    });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('settings');
    }
};
