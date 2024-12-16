<?php

namespace App\Domain\Geral\Configuracao\Models;

use App\Application\Models\BaseModel;

class Configuracao extends BaseModel
{
    const ID_CONFIGURACAO = 'id_configuracao';
    const CHAVE = 'chave';
    const VALOR = 'valor';

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'geral.configuracao';

    /**
     * The primary key associated with the table.
     *
     * @var string
     */
    protected $primaryKey = self::ID_CONFIGURACAO;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        self::CHAVE,
        self::VALOR
    ];
}
