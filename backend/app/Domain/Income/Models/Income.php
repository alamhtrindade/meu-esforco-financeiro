<?php

namespace App\Domain\Income\Models;

use App\Domain\Auditoria\Models\Registro;

class Income extends Registro
{
    const ID_INCOME = 'id_income';
    const VALUE = 'value';

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'Income';

    /**
     * The attributes that should be hidden.
     *
     * @var array
     */
    public $hidden = [
        "id_registro", "tabela", "criacao", "alteracao",
        "id_aplicacao_criador", "id_alterador", "id_aplicacao_alterador",
        "created_at", "updated_at"
    ];

    /**
     * The primary key associated with the table.
     *
     * @var string
     */
    protected $primaryKey = self::ID_INCOME;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        self::ID_INCOME,
        self::VALUE
    ];
}