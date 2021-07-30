<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSpecialitesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('specialites', function (Blueprint $table) {
            $table->increments('id');
			$table->text('specialite');
			$table->integer('compteur');
			$table->timestamps();
        });
		Schema::create('chirurgien_specialite', function (Blueprint $table) {
            $table->integer('chirurgien_id')->unsigned();
			$table->foreign('chirurgien_id')->references('id')
	      		->on('chirurgiens')->onDelete('cascade');
				
            $table->integer('specialite_id')->unsigned();
			$table->foreign('specialite_id')->references('id')
	      		->on('specialites')->onDelete('cascade');
				
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
        Schema::dropIfExists('specialites');
        Schema::dropIfExists('chirurgien_specialite');

    }
}
