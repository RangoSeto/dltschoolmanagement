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
        Schema::create('posts', function (Blueprint $table) {
            $table->id();
            $table->string('image')->nullable();
            $table->string('title');
            $table->string('slug');
            $table->longText('content');
            $table->decimal('fee',8,2)->default(0);
            $table->date('startdate')->nullable();
            $table->date('enddate')->nullable();
            $table->time('starttime')->nullable();
            $table->time('endtime')->nullable();
            $table->unsignedBigInteger('type_id');
            $table->unsignedBigInteger('tag_id');
            $table->unsignedBigInteger('attshow')->default('4');
            $table->unsignedBigInteger('status_id')->default('1');
            $table->unsignedBigInteger('user_id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('posts');
    }
};
