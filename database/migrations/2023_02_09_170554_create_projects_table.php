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
        Schema::create('projects', function (Blueprint $table) {
            $table->id();
            $table->foreignId('client_id');
            $table->tinyInteger('status')->comment('現在の状態');
            $table->string('name');
            $table->string('image_url')->comment('アイコン画像URL')->nullable();
            $table->date('start_date')->comment('開始日')->nullable();
            $table->date('end_date')->comment('終了日')->nullable();
            $table->text('content')->comment('案件内容')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('projects');
    }
};
