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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->string('email');
            $table->unsignedBigInteger('bike_id');
            $table->integer('quantity');
            $table->float('total_amount', 8, 2);
            $table->timestamps();

            $table->foreign('bike_id')
                  ->references('id')
                  ->on('bikes')
                  ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->dropForeign(['bike_id']);
        });

        Schema::dropIfExists('orders');
    }
};
