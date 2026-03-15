<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->string('name', 100);
            $table->text('description');
            $table->integer('price');
            $table->enum('status', ['selling', 'sold']);
            $table->enum('condition', ['新品・未使用', '良好', 'やや傷や汚れあり', '状態が悪い']);
            $table->foreignId('category_id')->constrained()->cascadeOnDelete();
            $table->string('brand', 100);
            $table->string('image');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products');
    }
}
