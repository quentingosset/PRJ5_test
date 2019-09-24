<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Sceance extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
     public function up()
     {
         if (!Schema::hasTable('seance')) {
             Schema::create('seance', function (Blueprint $table) {
                 $table->bigIncrements('id');
                 $table->integer('groupe_id');
                 $table->integer('courses_id');
                 $table->timestamp('dates');
             });
         }
     }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}