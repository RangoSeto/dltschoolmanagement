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
        Schema::table('students', function (Blueprint $table) {
            $table->string('image')->nullable()->after('regnumber');
            $table->date('dob')->nullable()->after('slug');
            $table->unsignedBigInteger('gender_id')->after('dob');
            $table->integer('age')->after('gender_id');
            $table->string('email')->after('age');
            $table->unsignedBigInteger('country_id')->after('email');
            $table->unsignedBigInteger('city_id')->after('country_id');
            $table->unsignedBigInteger('region_id')->nullable()->after('city_id');
            $table->unsignedBigInteger('township_id')->nullable()->after('region_id');
            $table->string('address')->nullable()->after('township_id');
            $table->unsignedBigInteger('religion_id')->nullable()->after('address');
            $table->string('nationalid')->unique()->nullable()->after('religion_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('students', function (Blueprint $table) {
            $table->dropColumn(['image','dob','gender_id','age','email','country_id','city_id','region_id','township_id','address','religion_id','nationalid']);
        });
    }
};
