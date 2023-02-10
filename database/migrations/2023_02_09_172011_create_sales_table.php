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
        Schema::create('sales', function (Blueprint $table) {
            $table->id();
            $table->foreignId('project_id');
            $table->tinyInteger('status')->comment('現在の状態');
            $table->string('content')->comment('売上内容');
            $table->integer('amount')->comment('金額');
            $table->date('sales_date')->comment('売上日');
            $table->date('planned_deposit_date')->comment('入金予定日');
            $table->date('deposit_date')->nullable()->comment('入金日');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sales');
    }
};
