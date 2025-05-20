<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('ratings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            // Perbaikan: harus sesuai nama tabel sebenarnya yaitu 'musics'
            $table->foreignId('music_id')->constrained('musics')->onDelete('cascade');
            $table->boolean('like'); // true = like, false = dislike
            $table->text('comment')->nullable();
            $table->timestamps();

            $table->unique(['user_id', 'music_id']); // hanya satu rating per user per musik
        });
    }

    public function down()
    {
        Schema::dropIfExists('ratings');
    }
};
