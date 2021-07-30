<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateClientsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
         Schema::create('clients', function (Blueprint $table) {
          $table->increments('id');
			$table->integer('first');
			$table->integer('second');
			$table->integer('third');
			$table->integer('task_id')->unsigned();			
			
            $table->timestamps(); 				
			$table->foreign('task_id')->references('id')
	      		->on('specialites')->onDelete('cascade');
        });
	
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
       Schema::dropIfExists('clients');
    }
}
