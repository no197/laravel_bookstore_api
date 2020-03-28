<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 100);
            $table->string('adress',1000);
            $table->string('phone', 20);
            $table->string('note', 1000);
            $table->string('ship_status')->default(\App\Order::NOT_SHIPPED);
            $table->string('paid_status')->default(\App\Order::UNPAID_INVOICE);
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
        Schema::dropIfExists('orders');
    }
}
