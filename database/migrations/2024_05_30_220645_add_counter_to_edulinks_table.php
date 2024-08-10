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
        Schema::table('edulinks', function (Blueprint $table) {
            $table->unsignedBigInteger('counter')->default(0)->after('url');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('edulinks', function (Blueprint $table) {
            $table->dropColumn('counter');
        });
    }
};


// php artisan make:migration add_counter_to_edulinks_table --table=edulinks