<?php

namespace Model\Entity;

use DateTime;

/**
 * @property int $empNo (emp_no)
 * @property Salary[] $salaries m:belongsToMany(emp_no:salaries)
 * @property Department[] $departments m:hasMany(emp_no:dept_emp:dept_no:departments)
 * @property DateTime $birthDate (birth_date)
 * @property string $firstName (first_name)
 * @property string $lastName (last_name)
 * @property string $gender
 * @property DateTime $hireDate (hire_date)
 */
class Employee extends \LeanMapper\Entity
{

}
