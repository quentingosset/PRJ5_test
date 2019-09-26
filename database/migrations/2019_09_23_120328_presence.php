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
                $table->integer("seance_id");
                $table->integer('matricules');
                $table->integer('types');
            });
        }
    }
}
