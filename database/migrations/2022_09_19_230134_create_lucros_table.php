<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLucrosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lucros', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->float('total',10,2);
            $table->integer('ref_mes');
            $table->integer('ref_ano');
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('lucros', function (Blueprint $table) {
            $table->dropForeign('lucros_user_id_foreign');
            $table->dropColumn('user_id');
        });
        Schema::dropIfExists('lucros');
    }
}
