<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

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
            $table->id();
            $table->integer('user_id');
            $table->string('name')->nullable();;
            $table->string('address')->nullable();
            $table->string('city')->nullable();
            $table->string('country')->nullable();
            $table->string('zipcode')->nullable();
            $table->string('mobile')->nullable();
            $table->string('email')->nullable();;
            $table->float('shipping_charges')->nullable();
            $table->string('coupon_code')->nullable();
            $table->float('coupon_amount')->nullable();
            $table->string('order_status')->nullable();
            $table->string('pay_method')->nullable();
            $table->string('pay_gateway')->nullable();
            $table->float('grand_total')->nullable();
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
