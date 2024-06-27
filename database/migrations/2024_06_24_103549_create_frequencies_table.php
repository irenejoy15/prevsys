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
        Schema::create('frequencies', function (Blueprint $table) {
            $table->uuid('id')->primary()->unique();
            $table->string('frequency');
            $table->boolean('is_jan');
            $table->boolean('is_feb');
            $table->boolean('is_mar');
            $table->boolean('is_apr');
            $table->boolean('is_may');
            $table->boolean('is_jun');
            $table->boolean('is_jul');
            $table->boolean('is_aug');
            $table->boolean('is_sept');
            $table->boolean('is_oct');
            $table->boolean('is_nov');
            $table->boolean('is_dec');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('frequencies');
    }
};
