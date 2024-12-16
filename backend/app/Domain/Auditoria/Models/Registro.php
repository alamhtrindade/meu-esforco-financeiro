<?php

namespace App\Domain\Auditoria\Models;

use Illuminate\Database\Eloquent\Model;

class Registro extends Model
{
    public static function campoCompleto(
        string|array $campo,
        bool $isRaw = false
    ): string|array
    {
        if (is_array($campo)) {
            return $isRaw===true ?
                    implode(',',array_map(fn($c) => self::nomeTabela() . '.' . $c, $campo)) :
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