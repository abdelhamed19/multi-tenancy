<?php

use App\Models\Image;
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
        Schema::create('images', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->cascadeOnDelete();
            $table->string('path');
            $table->timestamps();
        });
        // Image::create([
        //     'user_id' => 1,
        //     'path' => 'image1.jpg',
        // ]);
        // Image::create([
        //     'user_id' => 2,
        //     'path' => 'image2.jpg',
        // ]);
        // Image::create([
        //     'user_id' => 3,
        //     'path' => 'image3.jpg',
        // ]);
        // Image::create([
        //     'user_id' => 4,
        //     'path' => 'image4.jpg',
        // ]);
        // Image::create([
        //     'user_id' => 5,
        //     'path' => 'image5.jpg',
        // ]);
        // Image::create([
        //     'user_id' => 6,
        //     'path' => 'image6.jpg',
        // ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('images');
    }
};
