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
        Schema::create('invoices', function (Blueprint $table) {
            $table->id();
            $table->date("date_send");
            $table->date("date_pay");
            $table->string("amount");
            $table->string("number_invoice");
            $table->foreignId("project_id")->constrained();
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
        Schema::table('invoices', function(Blueprint $table){
            $table->dropForeign(["project_id","customer_id"]);
        });
        Schema::dropIfExists('invoices');
    }
};
