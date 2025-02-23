<?php

namespace App\Domain\Person\Services;

use App\Domain\Person\Contracts\ReadPersonRepositoryInterface;
use App\Domain\Person\Contracts\ReadPersonServiceInterface;

class ReadPersonService  implements ReadPersonServiceInterface
{
    public function __construct(
        private ReadPersonRepositoryInterface $readPersonRepository
    ) {}

    public function read(
        $idPerson,
        $month
    ){
        $year = 2025;
        if($idPerson && $month){
            return $this->readPersonRepository->readByPersonAndMonth($idPerson, $month, $year);
        }else{
            $month = date('n');
            return $this->readPersonRepository->readAll($month)->toArray();
        }
    }
}