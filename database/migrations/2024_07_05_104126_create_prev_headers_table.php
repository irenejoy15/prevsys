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
            $table->boolean('1st_week')->default(0);
            $table->boolean('2st_week')->default(0);
            $table->boolean('3rd_week')->default(0);
            $table->boolean('4th_week')->default(0);
            $table->boolean('5th_week')->default(0);
            $table->date('date_from')->nullable();
            $table->date('date_to')->nullable();
            $table->text('remarks_1')->default('');
            $table->text('remarks_2')->default('');
            $table->text('remarks_3')->default('');
            $table->text('remarks_4')->default('');
            $table->text('remarks_5')->default('');
            $table->string('assigned')->default('');
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
