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
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('resume');
            $table->text('description');

            $table->decimal('price', 10, 2);
            $table->decimal('height', 8, 2);
            $table->decimal('width',  8, 2);
            $table->decimal('depth',  8, 2);
            $table->decimal('weight',  8, 2);
            $table->integer('amount');
            $table->string('active')->default('OK');
            $table->string('slug');

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
