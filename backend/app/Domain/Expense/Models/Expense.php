<?php

namespace App\Domain\Expense\Models;

use App\Domain\Auditoria\Models\Registro;

class Expense extends Registro
{
    const ID_EXPENSE = 'id_expense';
    const VALUE = 'value';

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'Expense';

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
    protected $primaryKey = self::ID_EXPENSE;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        self::ID_EXPENSE,
        self::VALUE
    ];
}
