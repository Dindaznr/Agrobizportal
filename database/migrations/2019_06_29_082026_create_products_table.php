<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

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
            $table->increments('id');
            $table->timestamps();

            $table->integer('user_id')->unsigned();
            
            $table->string('name');
            $table->string('slug');
            $table->string('description', 500);
            $table->text('image')->nullable();
            $table->integer('price');
            $table->integer('stock')->default(1);
            $table->boolean('active')->default(1);

            $table->integer('rate_count')->default(0)->nullable();
            $table->integer('sale_counts')->default(0)->unsigned();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
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
