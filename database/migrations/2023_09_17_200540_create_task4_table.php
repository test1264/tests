<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('clients', function (Blueprint $table) {
            $table->id();
            $table->string('name', 100);
            $table->string('city', 100);
        });

        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name', 100);
            $table->integer('price')->default(100);
        });

        Schema::create('ratings', function (Blueprint $table) {
            $table->id();

            $table->bigInteger('id_client')->unsigned();
            $table->bigInteger('id_product')->unsigned();
            $table->bigInteger('id_review')->unsigned()->nullable(true);
            $table->integer('rating')->default(10);

            $table->foreign('id_client')->references('id')->on('clients');
            $table->foreign('id_product')->references('id')->on('products');
            $table->foreign('id_review')->references('id')->on('reviews');
        });

        Schema::create('reviews', function (Blueprint $table) {
            $table->id();

            $table->bigInteger('id_client')->unsigned();
            $table->bigInteger('id_product')->unsigned();
            $table->bigInteger('id_rating')->unsigned()->nullable(true);
            $table->string('review', 100);
            $table->integer('likes')->default(0);

            $table->foreign('id_client')->references('id')->on('clients');
            $table->foreign('id_product')->references('id')->on('products');
            $table->foreign('id_rating')->references('id')->on('ratings');
        });

        DB::statement('ALTER TABLE `ratings` ADD FOREIGN KEY (`id_review`) REFERENCES `reviews`(`id`) ;');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('clients');
        Schema::dropIfExists('products');
        Schema::dropIfExists('ratings');
        Schema::dropIfExists('reviews');
    }
};
