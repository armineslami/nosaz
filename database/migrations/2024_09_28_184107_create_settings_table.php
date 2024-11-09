<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('settings', function (Blueprint $table) {
            $table->id();
            $table->enum("app_theme", ['light', 'dark', 'system'])->default('system');
            $table->integer("app_paginate_number")->default(20);
            $table->integer("app_max_decimal_place")->default(2);
            $table->enum("app_scalable", [0, 1])->default(0);
            $table->enum("app_show_default_formula", [0, 1])->default(1);
            $table->unsignedBigInteger('user_id');

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
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
