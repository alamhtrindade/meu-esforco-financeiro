<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

class EstruturaInicial extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $sql = 'database/migrations/scripts/2025_02_22_000000_estrutura_inicial.sql';
        DB::unprepared(file_get_contents($sql));
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