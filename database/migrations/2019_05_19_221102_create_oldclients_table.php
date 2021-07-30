<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOldclientsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
         Schema::create('oldclients', function (Blueprint $table) {
          $table->increments('id');
			$table->text('nom_prenom');
			$table->string('description',500);
			$table->text('pays');
			$table->string('URL', 500);
			$table->text('email');
			$table->integer('telephone');
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
       Schema::dropIfExists('oldclients');
    }
}
