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
        Schema::create('book_user', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('book_id')->constrained()->onDelete('cascade');
            $table->longText('notes')->nullable();
            $table->tinyInteger('rating')->nullable(); // 1 to 5
            $table->date('reading_start')->nullable();
            $table->integer('current_page')->nullable();
            $table->date('reading_end')->nullable();
            $table->enum('reading_status', ['read','in progress', 'did not finish', 'wishlist', 'pause', 'to be read'])->nullable();
            $table->timestamps();
            
            $table->unique(['user_id', 'book_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('book_user');
    }
};
