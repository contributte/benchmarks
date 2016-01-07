<?php

namespace Model\Repository;

use DibiConnection;
use Model\Entity\Employee;

/**
 * @entity Model\Entity\Employee
 */
class EmployeesRepository extends \LeanMapper\Repository
{

	/**
	 * @param int $limit
	 * @return Employee[]
	 */
	public function findAll($limit)
	{
		return $this->createEntities(
			$this->connection->fetchAll('SELECT * FROM %n %lmt', $this->getTable(), $limit)
		);
	}

}
