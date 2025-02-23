<?php

namespace App\Domain\PersonIncome\Models;

use App\Domain\Auditoria\Models\Registro;

class PersonIncome extends Registro
{
    const ID_PERSON_INCOME = 'id_person_income';
    const ID_PERSON = 'id_person';
    const ID_INCOME = 'id_income';
    const DATE_INCOME = 'date_income';

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'Person_Income';

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
    protected $primaryKey = self::ID_PERSON_INCOME;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        self::ID_PERSON_INCOME,
        self::ID_PERSON,
        self::ID_INCOME,
        self::DATE_INCOME
    ];
}