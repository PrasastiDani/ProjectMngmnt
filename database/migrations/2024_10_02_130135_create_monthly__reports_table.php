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
        Schema::create('monthly__reports', function (Blueprint $table) {
            $table->id('report_id');
            $table->integer('month')->nullable();
            $table->integer('year')->nullable();
            $table->decimal('total_income', 10, 2)->nullable();
            $table->decimal('net_profit', 10, 2)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('monthly__reports');
    }
};
