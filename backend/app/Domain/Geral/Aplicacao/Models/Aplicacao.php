<?php

namespace App\Domain\Geral\Aplicacao\Models;


use App\Application\Models\BaseModel;

class Aplicacao extends BaseModel
{

    const ID_APLICACAO = 'id_aplicacao';
    const NOME = 'nome';
    const SIGLA = 'sigla';

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'geral.aplicacao';

    /**
     * The primary key associated with the table.
     *
     * @var string
     */
    protected $primaryKey = self::ID_APLICACAO;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        self::NOME,
        self::SIGLA
    ];
}
