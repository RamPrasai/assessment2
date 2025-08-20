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
    Schema::create('posts', function (Blueprint $table) {
        $table->id();                                // Primary key
        $table->string('title', 50);                 // Title (max 50 chars)
        $table->text('content');                     // Content body
        $table->unsignedBigInteger('user_id');       // Reference to users.id
        $table->unsignedBigInteger('category_id');   // Reference to categories.id
        $table->enum('is_active', ['Yes','No'])->default('Yes'); // Status flag
        $table->timestamps();                        // created_at and updated_at

        // Foreign key constraints
        $table->foreign('user_id')
              ->references('id')->on('users')
              ->onDelete('cascade');

        $table->foreign('category_id')
              ->references('id')->on('categories')
              ->onDelete('cascade');
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('posts');
    }
};
