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
        Schema::create('players', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('teams_id');
            $table->foreign('teams_id')
                ->references('id')->on('teams')->onDelete('cascade');
            $table->string('nickname');
            $table->string('fi')->nullable();
            $table->string('photo')->nullable();
            $table->boolean('verified')->default(0);
            $table->boolean('isCoach');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('players');
    }
};
