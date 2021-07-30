<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateChirurgienTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
    	 Schema::create('chirurgiens', function(Blueprint $table)
	  {
	    	$table->increments('id');
			$table->text('fullname');
			$table->integer('age');
			$table->text('telephone');
			$table->string('URL');
						
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
             Schema::dropIfExists('chirurgiens');
    }
}
