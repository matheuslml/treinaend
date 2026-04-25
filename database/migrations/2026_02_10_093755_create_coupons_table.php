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
        Schema::create('coupons', function (Blueprint $table) {
            $table->id();
            $table->integer('course_id')->constrained('courses')->nullable();
            $table->string('title')->nullable();
            $table->string('slug')->nullable();
            $table->string('observation')->nullable();
            $table->string('code')->nullable();
            $table->integer('amount')->nullable();
            $table->integer('discount_percentage')->nullable();
            $table->date('started_at', $precision = 0)->nullable();
            $table->date('finished_at', $precision = 0)->nullable();
            $table->enum('status', ['PUBLISHED', 'DRAFT', 'BLOCKED'])->default('DRAFT');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('coupons');
    }
};
