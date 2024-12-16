<?php

namespace App\Application\Helpers;

use Hamcrest\Type\IsNumeric;
use Illuminate\Contracts\Database\Eloquent\CastsAttributes;
use Illuminate\Support\Facades\DB;

class PostgresEncryptedHelper implements CastsAttributes
{

    public static function selectDecryptColumn($column)
    {
        $stringDecrypt = self::stringDecryptColumn($column);

        return DB::raw("$stringDecrypt AS $column");
    }

    public static function stringDecryptColumn($column, $alias = '')
    {
        $alias = $alias ? "AS {$alias}" : '';

        return DB::raw(sprintf("PGP_SYM_DECRYPT(%s::bytea, current_setting('saude_mental.conf')) {$alias}", $column));
    }

    public static function encrypt($value)
    {
        $encrypted = DB::select("SELECT PGP_SYM_ENCRYPT(?, current_setting('saude_mental.conf'))::text AS value",
            [$value]
        );
        return $encrypted[0]->value;
    }
    public static function decrypt($value)
    {
        $decrypted = DB::select("SELECT PGP_SYM_DECRYPT(?::bytea, current_setting('saude_mental.conf')) AS value",
            [$value]
        );
        return $decrypted[0]->value;
    }

    public static function geralDescriptografa($column, $as): string
    {
        return " geral.descriptografa({$column}) as {$as} ";
    }

    public static function geralCriptografa($value): string
    {
        return " geral.criptografa({$value}) ";
    }

    public function get($model, $key, $value, $attributes)
    {
        if (is_null($value) || empty($value)) {
            return null;
        }

        return self::decrypt($value);
    }


    public function set($model, $key, $value, $attributes)
    {
        if ((is_null($value) || empty($value)) && !is_numeric($value)) {
            return null;
        }

        return self::encrypt($value);
    }
}
