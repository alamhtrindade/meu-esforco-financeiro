<?php

namespace App\Domain\PersonExpense\Models;

use App\Domain\Auditoria\Models\Registro;

class PersonExpense extends Registro
{
    const ID_PERSON_EXPENSE = 'id_person_expense';
    const ID_PERSON = 'id_person';
    const ID_EXPENSE = 'id_expense';
    const DATE_EXPENSE = 'date_expense';

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'Person_Expense';

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
    protected $primaryKey = self::ID_PERSON_EXPENSE;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        self::ID_PERSON_EXPENSE,
        self::ID_PERSON,
        self::ID_EXPENSE,
        self::DATE_EXPENSE
    ];
}