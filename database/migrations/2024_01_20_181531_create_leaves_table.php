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
        Schema::create('leaves', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('post_id');
            $table->date('startdate');
            $table->date('enddate');
            $table->unsignedBigInteger('tag');
            $table->string('title');
            $table->longText('content');
            $table->string('image')->nullable();
            $table->enum('stage_id',[1,2,3])->default(2)->comment("1 = Approved, 2 = Pending, 3 = Reject");
            $table->unsignedBigInteger('authorize_id')->nullable();
            $table->unsignedBigInteger('user_id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('leaves');
    }
};
