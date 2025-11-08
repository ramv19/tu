<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('searches', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('name');
            $table->text('etimologia');
            $table->text('biblico');
            $table->text('simbolismo');
            $table->text('interpretacion');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('searches');
    }
};