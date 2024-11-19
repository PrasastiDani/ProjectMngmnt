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
        Schema::table('reservations', function (Blueprint $table) {
          // Menghapus kolom lama
          $table->dropColumn('event_type');
          // Menambahkan kolom baru
          $table->string('title')->after('event_date'); 
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('reservations', function (Blueprint $table) {
            // Menghapus kolom title
            $table->dropColumn('title');
            // Menambahkan kembali kolom event_type
            $table->string('event_type')->after('location'); 
        });
    }
};
