<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('comments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('search_id')->constrained()->onDelete('cascade');
            $table->text('comment');
            $table->integer('rating')->default(0);
            $table->boolean('is_approved')->default(true);
            $table->timestamps();
        });

        Schema::create('comment_likes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('comment_id')->constrained()->onDelete('cascade');
            $table->timestamps();
            
            $table->unique(['user_id', 'comment_id']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('comment_likes');
        Schema::dropIfExists('comments');
    }
};