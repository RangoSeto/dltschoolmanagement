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
        Schema::create('point_transfer_histories', function (Blueprint $table) {
            $table->id();
            $table->foreignId('points_transfers_id')->constrained('points_transfers');
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->enum('accounttype',['debit','credit']);
            $table->integer('points');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('point_transfer_histories');
    }
};
