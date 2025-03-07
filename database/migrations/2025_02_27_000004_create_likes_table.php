<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('likes', function (Blueprint $table) {
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('post_id')->constrained('posts')->onDelete('cascade')->onUpdate('cascade');
            $table->primary(['user_id', 'post_id']);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('eats');
    }
};
