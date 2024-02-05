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
        Schema::create('value_candles', function (Blueprint $table) {
                $table->id();
                $table->string("open");
                $table->string("min");
                $table->string("max");
                $table->string("close");
                $table->string("status");
                $table->datetime("created_at");
                $table->unsignedBigInteger('currency_id');
                $table->foreign('currency_id')->references('id')->on('currencys');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('value_candles');
    }
};
