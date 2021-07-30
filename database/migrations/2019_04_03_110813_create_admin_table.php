<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAdminTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('admins', function (Blueprint $table) {
          $table->increments('id');
			$table->text('nom');
			$table->text('prenom');
			$table->text('smalldescription');
			$table->string('fulldescription');
			$table->integer("age");
			$table->string('email')->unique();			
			$table->text('URL');			
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
       Schema::dropIfExists('admins');
    }
}
