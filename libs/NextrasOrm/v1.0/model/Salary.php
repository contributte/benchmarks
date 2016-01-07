<?php

namespace Model;

use DateTime;
use Nextras\Orm\Entity\Entity;

/**
 * @property Employee $employee {primary} {m:1 EmployeesRepository}
 * @property DateTime $fromDate {primary}
 * @property DateTime $toDate
 * @property int $salary
 */
class Salary extends Entity
{
}
