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
        Schema::create('assets', function (Blueprint $table) {
            $table->id('asset_id');
            $table->string('asset_name')->nullable();
            $table->string('category')->nullable();
            $table->decimal('purchase_cost', 10, 2)->nullable();
            $table->date('purchase_date')->nullable();
            $table->string('status')->nullable();
            $table->string('description')->nullable();   
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('assets');
    }
};