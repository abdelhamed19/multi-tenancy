<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

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
            $table->rememberToken();
            $table->timestamps();
        });

        // User::create([
        //     'name' => 'John Doe',
        //     'email' => 'john@example.com',
        //     'password' => Hash::make('password123'),
        // ]);

        // User::create([
        //     'name' => 'Jane Smith',
        //     'email' => 'jane@example.com',
        //     'password' => Hash::make('password123'),
        // ]);

        // User::create([
        //     'name' => 'Alice Johnson',
        //     'email' => 'alice@example.com',
        //     'password' => Hash::make('password123'),
        // ]);

        // User::create([
        //     'name' => 'Bob Williams',
        //     'email' => 'bob@example.com',
        //     'password' => Hash::make('password123'),
        // ]);

        // User::create([
        //     'name' => 'Charlie Brown',
        //     'email' => 'charlie@example.com',
        //     'password' => Hash::make('password123'),
        // ]);

        // User::create([
        //     'name' => 'Emily Davis',
        //     'email' => 'emily@example.com',
        //     'password' => Hash::make('password123'),
        // ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
