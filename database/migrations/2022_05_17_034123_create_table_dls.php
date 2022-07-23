<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('table_dls', function (Blueprint $table) {
            $table->increments('id_dls');
            $table->string('bulan');
            $table->integer('Ytd');
            $table->integer('MoM');
            $table->integer('YoY');
            $table->integer('FmAch');
            $table->integer('GAP_to_Target');
            $table->integer('GAP_MoM');
            $table->integer('GAP_Run_Rate');
            $table->integer('Daily_Run_Rate');
            $table->string('id_product');
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
        Schema::dropIfExists('table_dls');
    }
};
