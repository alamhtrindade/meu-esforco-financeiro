<?php

namespace App\Domain\Geral\TipoAnexo\Models;


use App\Application\Models\BaseModel;
use App\Domain\Geral\Anexo\Models\Anexo;

class TipoAnexo extends BaseModel
{
    const ID_TIPO_ANEXO = 'id_tipo_anexo';
    const DESCRICAO = 'descricao';

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'geral.tipo_anexo';

    /**
     * The primary key associated with the table.
     *
     * @var string
     */
    protected $primaryKey = self::ID_TIPO_ANEXO;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        self::DESCRICAO
    ];

    public function anexos()
    {
        return $this->hasMany(Anexo::class, Anexo::ID_TIPO_ANEXO, self::ID_TIPO_ANEXO);
    }
}
