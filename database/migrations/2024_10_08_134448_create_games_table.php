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
        Schema::create('games', function (Blueprint $table) {
            $table->id();
            $table->foreignId('lotery_id')->constrained();
            $table->string('game_date');
            $table->foreignId('status_id')->default(1)->constrained('game_statuses');
            $table->float('total_prize');
            $table->foreignId('winner_id')->nullable()->constrained('users');
            $table->unsignedBigInteger('winner_number')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('games');
    }
};
