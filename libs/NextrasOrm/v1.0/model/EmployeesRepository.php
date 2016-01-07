<?php

namespace Model;

use Nextras\Orm\Repository\Repository;

class EmployeesRepository extends Repository
{

    public function findOverview($limit)
    {
        return $this->findAll()->limitBy($limit);
    }

}
