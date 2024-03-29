<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCurrencyDataTable extends Migration
{
    public function up(): void
    {
        Schema::create('currency_data', function (Blueprint $table) {
            $table->id();
            $table->date('date');
            $table->json('data');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('currency_data');
    }
}
