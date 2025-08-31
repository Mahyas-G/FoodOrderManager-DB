<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void {
        Schema::create('payment_history', function (Blueprint $t) {
            $t->id();
            $t->foreignId('payment_id')->constrained('payments')->cascadeOnDelete();
            $t->string('event');     // created|callback|verify|...
            $t->json('payload')->nullable();
            $t->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void { Schema::dropIfExists('payment_history'); }

};
