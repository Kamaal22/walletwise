<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('exports', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('user_id');
            $table->string('filename')->nullable();
            $table->string('status')->default('queued'); // queued, processing, done, failed
            $table->string('format')->nullable();
            $table->json('params')->nullable();
            $table->text('error')->nullable();
            $table->timestamps();
            $table->timestamp('completed_at')->nullable();

            $table->index('user_id');
        });
    }

    public function down()
    {
        Schema::dropIfExists('exports');
    }
};
