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
        Schema::table('comment_images', function (Blueprint $table) {
            //
            $table->foreignId('usuario_id')->constrained('users')->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('imagen_id')->constrained('images')->onUpdate('cascade')->onDelete('cascade');


        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('comment_images', function (Blueprint $table) {
            //
            $table->dropForeign('usuario_id');
            $table->dropColumn('usuario_id');
            $table->dropForeign('imagen_id');
            $table->dropColumn('imagen_id');
        });
    }
};
