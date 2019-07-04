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
            $table->timestamps();
            $table->softDeletes();

            $table->integer('customer_id')->unsigned();
            $table->integer('address_id')->unsigned()->nullable();
            $table->integer('seller_id')->unsigned()->nullable();
            
            $table->enum('status', ['sent', 'cancelled', 'closed', 'open', 'paid', 'pending', 'received']);
            $table->enum('type', ['cart', 'wishlist', 'order', 'later']);
            $table->string('description', 150)->nullable();
            $table->dateTime('end_date')->nullable(); //cancelled or paid
            
            // $table->foreign('customer_id')->references('id')->on('users');
            // $table->foreign('address_id')->references('id')->on('addresses');
            // $table->foreign('seller_id')->references('id')->on('users');
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
