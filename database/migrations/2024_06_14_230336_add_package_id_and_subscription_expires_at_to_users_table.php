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
        Schema::table('users', function (Blueprint $table) {
            $table->foreignId('package_id')->nullable()->after('last_active')->constrained()->onDelete("set null");
            $table->timestamp('subscription_expires_at')->nullable()->after('package_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropForeign(['package_id']);
            $table->dropColumn('package_id');
            $table->dropColumn('subscription_expires_at');
        });
    }
};


// php artisan make:migration add_package_id_and_subscription_expires_at_to_users_table --table=users
