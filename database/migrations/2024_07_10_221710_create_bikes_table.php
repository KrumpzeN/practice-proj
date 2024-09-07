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
        Schema::create('bikes', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('bike_brand_id');
            $table->unsignedBigInteger('bike_type_id');
            $table->float('price');
            $table->string('name');
            $table->boolean('availability');
            $table->foreign('bike_brand_id')
                  ->references('id')
                  ->on('bike_brands')
                  ->onDelete('restrict');
            $table->foreign('bike_type_id')
                  ->references('id')
                  ->on('bike_types')
                  ->onDelete('restrict');
            $table->string('article')->unique();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('bikes', function (Blueprint $table) {
            $table->dropForeign(['bike_brand_id']);
            $table->dropForeign(['bike_type_id']);
        });

        Schema::dropIfExists('bikes');
    }
};
