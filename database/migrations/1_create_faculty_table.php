<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('faculties', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('image')->nullable();
            $table->timestamps();
        });
        $faculties = [
            'Information Technology', 'Medicine', 'Biology',
             'Engineering', 'Science', 'Arts & Literature',
              'Business', 'Law', 'Social Science',
               'Agriculture'];

        foreach ($faculties as $faculty) {
            DB::table('faculties')->insert([
                'name' => $faculty,
                'image' => 'background/default_faculty.jpg', // This will generate a random image URL
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('faculties');
    }
};
