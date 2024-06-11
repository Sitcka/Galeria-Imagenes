<?php

use App\Models\Galery;
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
        Schema::create('galery_image', function (Blueprint $table) {
            $table->id();
            $table->foreignId('galery_id')->constrained('galeries')->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('image_id')->constrained('images')->onUpdate('cascade')->onDelete('cascade');
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('galery_image');
    }
};
