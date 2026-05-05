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
        Schema::create('discipline_people_exercise', function (Blueprint $table) {
            $table->id();
            $table->integer('discipline_people_id')->constrained('discipline_people')->nullable();
            $table->integer('exercise_id')->constrained('exercises')->nullable();
            $table->string('answer')->nullable();
            $table->boolean('correct')->default(false);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('discipline_people_exercise');
    }
};