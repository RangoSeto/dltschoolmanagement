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
        Schema::create('leads', function (Blueprint $table) {
            $table->id();
            $table->string('leadnumber')->unique();
            $table->string('firstname');
            $table->string('lastname')->nullable();
            $table->unsignedBigInteger('gender_id');
            $table->integer('age');
            $table->string('email');
            $table->unsignedBigInteger('country_id');
            $table->unsignedBigInteger('city_id');
            $table->unsignedBigInteger('user_id')->nullable();
            $table->boolean('converted')->default(false);
            $table->unsignedBigInteger('student_id')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('leads');
    }
};

