<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
{
    Schema::create('rentals', function (Blueprint $table) {
        $table->id();
        $table->unsignedBigInteger('equipment_id');
        $table->string('student_name');
        $table->integer('year_level');  // Ensure this exists and is an integer
        $table->date('rental_date');
        $table->timestamps();
    
        $table->foreign('equipment_id')->references('id')->on('equipment');
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rentals');
    }
};
