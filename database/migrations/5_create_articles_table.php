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
        Schema::create('articles', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('intro');
            $table->string('image')->nullable();
            $table->string('content');
            $table->boolean('selected')->default(false);
            $table->boolean('published')->default(false);
            $table->boolean('anonymous')->default(false);

            $table->unsignedBigInteger('author_id')->nullable();
            $table->unsignedBigInteger('faculty_id')->nullable(); 
            $table->unsignedBigInteger('magazine_id');
         

            $table->timestamps();

            $table->foreign('author_id')->references('id')->on('users')->onDelete('set null');
            $table->foreign('magazine_id')->references('id')->on('magazines')->onDelete('cascade');        
            $table->foreign('faculty_id')->references('id')->on('faculties')->onDelete('restrict');
   
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('articles');
    }
};
