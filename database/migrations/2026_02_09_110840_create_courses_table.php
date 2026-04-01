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
        Schema::create('courses', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->string('acronym')->nullable();
            $table->integer('order')->nullable();
            $table->integer('grade')->nullable();
            $table->float('payment_value', 16, 2)->nullable();
            $table->string('observation_certificate')->nullable();
            $table->string('coordinator_certificate')->nullable();
            $table->string('image_certificate')->nullable();
            $table->string('image_banner')->nullable();
            $table->enum('type', ['EAD', 'PRESENCIAL'])->default('EAD');
            $table->text('excerpt')->nullable();
            $table->text('body')->nullable();
            $table->text('meta_description')->nullable();
            $table->text('meta_keywords')->nullable();
            $table->enum('status', ['PUBLISHED', 'DRAFT', 'BKDNEWREGISTRATION', 'BLOCKED'])->default('DRAFT');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('courses');
    }
};
