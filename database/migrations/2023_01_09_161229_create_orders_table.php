<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
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
            $table->date("date_order");
            $table->string("amount");
            $table->string("number_order");
            $table->enum('types', ['Payé', 'Non Payé'])->default('Non Payé');
            $table->foreignId("product_id")->constrained();
            $table->foreignId("customer_id")->constrained();
            $table->timestamps();
        });
        Schema::enableForeignKeyConstraints();
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('orders', function(Blueprint $table){
            $table->dropForeign(["product_id","customer_id"]);
        });
        Schema::dropIfExists('orders');
    }
};
