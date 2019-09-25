<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Presence extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('presence')) {
            Schema::create('presence', function (Blueprint $table) {
                $table->bigIncrements('id');
                $table->timestamp('date');
                $table->integer('course_id');
                $table->integer('groupe_id');
                $table->integer('students_id');
                $table->integer('types');
            });
        }
    }
}
