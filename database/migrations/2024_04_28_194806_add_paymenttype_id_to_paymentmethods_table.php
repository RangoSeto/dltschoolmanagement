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
        Schema::table('paymentmethods', function (Blueprint $table) {
            $table->unsignedBigInteger('paymenttype_id')->after('slug');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('paymentmethods', function (Blueprint $table) {
            $table->dropColumn('paymenttype_id');
        });
    }
};


// php artisan make:migration add_paymenttype_id_to_paymentmethods_table --table=paymentmethods