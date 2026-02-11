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
        Schema::create('support_materials', function (Blueprint $table) {
            $table->id();
            $table->integer('discipline_id')->constrained('disciplines')->nullable();
            $table->string('title')->nullable();
            $table->string('link')->nullable();
            $table->string('icon')->nullable();
            $table->integer('order')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('support_materials');
    }
};
