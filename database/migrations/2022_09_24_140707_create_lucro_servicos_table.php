<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLucroServicosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lucro_servicos', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('servico_id');
            $table->unsignedBigInteger('lucro_id');
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('servico_id')->references('id')->on('servicos');
            $table->foreign('lucro_id')->references('id')->on('lucros');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('lucro_servicos', function (Blueprint $table) {
            $table->dropForeign('lucro_servicos_user_id_foreign');
            $table->dropColumn('user_id');
            $table->dropForeign('lucro_servicos_servico_id_foreign');
            $table->dropColumn('servico_id');
            $table->dropForeign('lucro_servicos_lucro_id_foreign');
            $table->dropColumn('lucro_id');
        });
        Schema::dropIfExists('lucro_servicos');
    }
}
