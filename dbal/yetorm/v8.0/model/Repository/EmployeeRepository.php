<?php

namespace Model\Repository;

use YetORM\Repository;

/**
 * @table employees
 */
class EmployeeRepository extends Repository
{

	/** @var string */
	protected $entity = 'Model\Entity\Employee';

}
