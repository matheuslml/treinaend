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
        Schema::create('registrations', function (Blueprint $table) {
            $table->id();
            $table->integer('person_id')->constrained('people')->nullable();
            $table->string('payment_form')->nullable();
            $table->enum('payment_status', ['S', 'N', 'NãoNPagoNpelaNBASF', ''])->default('N')->nullable();
            $table->float('payment_value', 16, 2)->nullable();
            $table->string('code')->nullable();
            $table->string('information')->nullable();
            $table->enum('qualification', ['S', 'N', ''])->default('N')->nullable();
            $table->string('front_certificate')->nullable();
            $table->string('back_certificate')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('registrations');
    }
};
