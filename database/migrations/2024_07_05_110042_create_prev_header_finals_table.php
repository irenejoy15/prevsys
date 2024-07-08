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
        Schema::create('prev_header_finals', function (Blueprint $table) {
            $table->uuid('id')->primary()->unique();
            $table->uuid('prev_header_id')->index();
            $table->text('remarks_1')->default('');
            $table->text('remarks_2')->default('');
            $table->text('remarks_3')->default('');
            $table->text('remarks_4')->default('');
            $table->text('remarks_5')->default('');
            $table->string('attachment')->default('');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('prev_header_finals');
    }
};
