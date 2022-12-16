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
        Schema::create('employees', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('lastname');
            $table->char('sexe');
            $table->string('phone');
            $table->string('avatar')->nullable();
            $table->date('annee_debut');
            $table->string('adresse');
            $table->date('naissance');
            $table->string('ville');
            $table->string('pays');
            $table->foreignId("departement_id")->constrained();
            $table->foreignId("direction_id")->constrained();
            $table->foreignId("user_id")->constrained();
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
        Schema::table('employees', function(Blueprint $table){
            $table->dropForeign(["user_id","departement_id","direction_id"]);
        });

        Schema::dropIfExists('employees');
    }
};
