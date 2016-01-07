<?php

namespace Model;

use DateTime;
use Nextras\Orm\Entity\Entity;

/**
 * @property Salary[] $salaries {1:m SalariesRepository $employee}
 * @property Department[] $departments {m:n DepartmentsRepository $employees primary}
 * @property DateTime $birthDate
 * @property string $firstName
 * @property string $lastName
 * @property string $gender
 * @property DateTime $hireDate
 */
class Employee extends Entity
{
}
