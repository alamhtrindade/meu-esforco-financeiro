<?php

namespace App\Application\Models;

use App\Application\Enums\ArrayKeysEnum;
use App\Domain\Geral\Aplicacao\Models\Aplicacao;
use App\Domain\Usuario\Usuario\Models\Usuario;
use Illuminate\Database\Eloquent\Model;

class BaseModel extends Model
{

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'auditoria.registro';

    /**
     * The primary key associated with the table.
     *
     * @var string
     */
    protected $primaryKey = 'id_registro';

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'criacao' => 'datetime',
        'alteracao' => 'datetime',
    ];

    /**
     * The attributes that should be hidden.
     *
     * @var array
     */
    public $hidden = [
        "id_registro", "tabela", "criacao", "alteracao", "id_criador",
        "id_aplicacao_criador", "id_alterador", "id_aplicacao_alterador",
    ];

    /**
     * Merge fillable fields and init attributes
     *
     * @param array $attributes
     */
    public function __construct(array $attributes = [])
    {
        $this->mergeFillable([
            'tabela',
            'criacao',
            'alteracao',
            'id_criador',
            'id_aplicacao_criador',
            'id_alterador',
            'id_aplicacao_alterador',
        ]);

        parent::__construct($attributes);
    }

    /**
     * The "booted" method of the model.
     *
     * @return void
     */
    protected static function booted()
    {
        static::creating(function ($registro) {
            $registro->id_criador = $registro->id_criador ?? auth()->id() ?? null;
            $registro->id_aplicacao_criador = $registro->id_aplicacao_criador
                ?? ArrayKeysEnum::APPLICATION_SISTEMA
                ?? null;
        });
        static::updating(function ($registro) {
            $registro->id_alterador = $registro->id_alterador ?? auth()->id() ?? null;
            $registro->id_aplicacao_alterador = $registro->id_aplicacao_alterador
                ?? ArrayKeysEnum::APPLICATION_SISTEMA
                ?? null;
        });
    }

    /**
     * Usuário que criou o registro
     *
     */
    public function criador()
    {
        return $this->belongsTo(Usuario::class, 'id_usuario', 'id_criador');
    }

    /**
     * Usuário que editou o registro
     *
     */
    public function alterador()
    {
        return $this->belongsTo(Usuario::class, 'id_usuario', 'id_alterador');
    }

    /**
     * Aplicação que criou o registro
     *
     */
    public function aplicacaoCriador()
    {
        return $this->belongsTo(Aplicacao::class, 'id_aplicacao', 'id_aplicacao_criador');
    }

    /**
     * Aplicação que editou o registro
     *
     */
    public function aplicacaoAlterador()
    {
        return $this->belongsTo(Aplicacao::class, 'id_aplicacao', 'id_aplicacao_alterador');
    }

    public static function campoCompleto(string|array $campo, bool $isRaw = false): string|array
    {
        if (is_array($campo)) {
            return $isRaw===true?
                implode(',', array_map(fn($c) => self::nomeTabela() . '.' . $c, $campo)):
                array_map(fn($c) => self::nomeTabela() . '.' . $c, $campo);
        } else {
            return self::nomeTabela() . '.' . $campo;
        }
    }

    /**
     * Retorna o nome da tabela
     *
     * @return string
     */
    public static function nomeTabela(): string
    {
        return (new static)->getTable();
    }
}
