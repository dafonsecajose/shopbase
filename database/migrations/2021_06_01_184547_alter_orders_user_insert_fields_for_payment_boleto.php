<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterOrdersUserInsertFieldsForPaymentBoleto extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('orders_user', function (Blueprint $table) {
            $table->string('type_payment')->default('CREDITCARD');
            $table->string('link_boleto')->nullable(true);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('orders_user', function (Blueprint $table) {
            $table->dropColumn('link_boleto');
            $table->dropColumn('type_payment');
        });
    }
}
