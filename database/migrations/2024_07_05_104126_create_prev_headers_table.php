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
        Schema::create('prev_headers', function (Blueprint $table) {
            $table->uuid('id')->primary()->unique();
            $table->uuid('inventory_id')->index();
            $table->uuid('location_id')->index();
            $table->uuid('frequency_id')->index();
            $table->uuid('company_id')->index();
            $table->uuid('department_id')->index();
            $table->string('name');
            $table->integer('week_from')->default(1);
            $table->integer('week_to')->default(1);
            $table->date('date_from')->nullable();
            $table->date('date_to')->nullable();
            $table->text('remarks_1')->nullable();
            $table->text('remarks_2')->nullable();
            $table->text('remarks_3')->nullable();
            $table->text('remarks_4')->nullable();
            $table->text('remarks_5')->nullable();
            $table->string('assigned')->nullable();
            $table->integer('month');
            $table->integer('year');
            $table->string('is_onetime')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('prev_headers');
    }
};
