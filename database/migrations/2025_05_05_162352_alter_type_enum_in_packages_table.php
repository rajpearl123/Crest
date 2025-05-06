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
        Schema::table('packages', function (Blueprint $table) {
            DB::statement("ALTER TABLE packages MODIFY type ENUM('photography', 'videography', 'offers') NOT NULL");
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('packages', function (Blueprint $table) {
            DB::statement("ALTER TABLE packages MODIFY type ENUM('photography', 'videography') NOT NULL");
        });
    }
};
