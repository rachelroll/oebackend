<?php

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

            $table->string('name')->comment('产品名称');
            $table->tinyInteger('enable')->comment('启用禁用 0:禁用 1:启用');
            $table->string('cover')->comment('产品封面图');
            $table->string('imgs')->comment('产品细节图');
            $table->string('intro')->comment('产品简介');
            $table->string('desc')->comment('产品详情');
            $table->integer('price')->comment('价格(分)');
            $table->string('attr')->comment('产品属性');

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
        Schema::drop('products');
    }
}
