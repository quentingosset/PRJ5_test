<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Students extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('students')) {
            Schema::create('students', function (Blueprint $table) {
                $table->bigIncrements('idStudent');
                $table->integer('matricule');
                $table->integer('groupe');
                $table->string('nom');
                $table->string('prenom');
                $table->integer('age');
            });
        }
    }

}
