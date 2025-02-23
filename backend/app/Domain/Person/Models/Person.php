<?php

namespace App\Domain\Person\Models;

use App\Domain\Auditoria\Models\Registro;
use App\Domain\PersonExpense\Models\PersonExpense;
use App\Domain\PersonIncome\Models\PersonIncome;

class Person extends Registro
{
    const ID_PERSON = 'id_person';
    const NIF = 'nif';
    const NAME = 'name';

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'Person';

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
    protected $primaryKey = self::ID_PERSON;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        self::ID_PERSON,
        self::NIF,
        self::NAME
    ];

    public function credited()
    {
        return $this->hasMany(PersonIncome::class, 'id_person', 'id_person');
    }

    public function debited()
    {
        return $this->hasMany(PersonExpense::class, 'id_person', 'id_person');
    }
}