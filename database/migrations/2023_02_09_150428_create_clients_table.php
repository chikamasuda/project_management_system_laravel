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
        Schema::create('clients', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->tinyInteger('status')->comment('現在の状態');
            $table->string('name');
            $table->string('address')->nullable();
            $table->string('image_url')->nullable()->comment('アイコン画像URL');
            $table->string('site_url')->nullable()->comment('クライアントの企業サイトURL');
            $table->text('memo')->nullable()->comment('備考');
            $table->string('email')->nullable()->unique();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('clients');
    }
};
