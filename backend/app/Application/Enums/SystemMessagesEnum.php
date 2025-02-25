<?php

namespace App\Application\Enums;

use BenSampo\Enum\Enum;

final class SystemMessagesEnum extends Enum
{
    const METHOD_NOT_ALLOWED = 'Method not allowed.';
    const RESOURCE_NOT_FOUND = 'Resource not found.';
    const INTERNAL_SERVER_ERROR = 'Internal server error.';
    const UNAUTHORIZED = 'Unauthorized.';
    const NOT_FOUND = 'Not found.';
    const TOO_MANY_REQUESTS = 'Too Many Attempts.';

    const CHOSEN_DATE_BEFORE_TODAY = 'A data escolhida é anterior à data atual.';
    const END_IS_BEFOR_START = 'A data final é anterior à data inicial.';
    const CHOSEN_TIME_BEFORE_NOW = 'A hora escolhida é anterior à hora atual.';
    const CHOSEN_END_TIME_BEFORE_START_TIME = 'A hora final é anterior à hora inicial.';

    const DELETE_ERROR = 'Houve um erro ao tentar apagar o registro. Tente novamente!';
    const UPDATE_ERROR = 'Houve um erro ao tentar atualizar o registro. Tente novamente!';

    const SUCCESS = 'Sucesso';
    const DELETE_NOT_POSSIBLE = 'Não é possível deletar este registro.';
    
    const NIF_ARE_REGISTERED = 'O NIF escolhido já está cadastrado.';
}