<?php

namespace App\Application\Helpers;

use Illuminate\Support\Facades\Crypt;

final class CriptografiaHelper
{

    public static function criptografaString(string $chave): string
    {
        return (string) Crypt::encryptString($chave);
    }

    public static function descriptografaString(string $chave): string
    {
        return (string) Crypt::decryptString($chave);
    }
}
