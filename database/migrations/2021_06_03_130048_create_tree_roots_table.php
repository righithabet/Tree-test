<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTreeRootsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tree_roots', function (Blueprint $table) {
            $table->id();
            $table->integer('tree');
            $table->string('root');
            $table->integer('level');
            $table->integer('parent_order');
            $table->integer('order');
            $table->integer('grandfather_order');
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
        Schema::dropIfExists('tree_roots');
    }
}
