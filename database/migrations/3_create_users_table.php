<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');

            $table->unsignedBigInteger('role_id')->default(5); // Default role is 5 (guest)
            $table->foreign('role_id')->references('id')->on('roles')->onDelete('restrict');
                       
            $table->unsignedBigInteger('faculty_id')->nullable(); // Nullable because user may not belong to any faculty
            $table->foreign('faculty_id')->references('id')->on('faculties')->onDelete('restrict');


            $table->rememberToken();
            $table->foreignId('current_team_id')->nullable();
            $table->string('profile_photo_path', 2048)->nullable();
            $table->timestamps();
        });
        DB::table('users')->insert([
            'name' => 'Admin',
            'email' => 'admin@uniarctic.com',
            'password' => Hash::make('password'),
            'role_id' => 1, // Assuming 1 is the role_id for admin
            'email_verified_at' => now(),
        ]);
        DB::table('users')->insert([
            'name' => 'Manager',
            'email' => 'manager@uniarctic.com',
            'password' => Hash::make('password'),
            'role_id' => 2, // Assuming 1 is the role_id for admin
            'email_verified_at' => now(),
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
