<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePurchasesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('purchases', function (Blueprint $table) {
            $table->id();
            $table->foreignid('user_id')->constrained()->cascadeOnDelete();
            $table->foreignid('item_id')->constrained()->cascadeOnDelete();
            $table->foreignid('address_id')->constrained()->cascadeOnDelete();
            $table->string('payment');
            $table->unsignedInteger('price');
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
        Schema::dropIfExists('purchases');
    }
}
