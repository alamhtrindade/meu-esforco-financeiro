<?php

namespace App\Domain\Geral\Anexo\Models;

use App\Application\Models\BaseModel;
use App\Domain\Geral\TipoAnexo\Models\TipoAnexo;

class Anexo extends BaseModel
{
    const ID_ANEXO = 'id_anexo';
    const ARQUIVO = 'arquivo';
    const ID_TIPO_ANEXO = 'id_tipo_anexo';

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'geral.anexo';

    /**
     * The primary key associated with the table.
     *
     * @var string
     */
    protected $primaryKey = self::ID_ANEXO;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        self::ARQUIVO,
        self::ID_TIPO_ANEXO
    ];


    public function tipo()
    {
        return $this->belongsTo(TipoAnexo::class, TipoAnexo::ID_TIPO_ANEXO, self::ID_TIPO_ANEXO);
    }
}
