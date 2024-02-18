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
        Schema::create('faculties', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->timestamps();
        });
        $faculties = [
            'Faculty Not Assigned', 'Medicine', 'Biology',
             'Engineering', 'Science', 'Arts & Literature',
              'Business', 'Law', 'Social Science',
               'Agriculture'];

        foreach ($faculties as $faculty) {
            DB::table('faculties')->insert([
                'name' => $faculty,
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
