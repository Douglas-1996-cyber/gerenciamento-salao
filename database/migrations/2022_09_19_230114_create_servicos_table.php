<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateServicosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('servicos', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('corte_id');
            $table->float('valor_total', 10,2);
            $table->integer('ref_mes');
            $table->integer('ref_ano');
            $table->integer('qtd');
            $table->boolean('fechado');
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('corte_id')->references('id')->on('cortes');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('servicos', function (Blueprint $table) {
            $table->dropForeign('servicos_user_id_foreign');
            $table->dropColumn('user_id');
            $table->dropForeign('servicos_corte_id_foreign');
            $table->dropColumn('corte_id');
        });
        Schema::dropIfExists('servicos');
    }
}
