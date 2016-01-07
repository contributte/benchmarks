<?php

namespace Model\Entity;

use YetORM;


class Employee extends YetORM\Entity
{

	/** @return string */
	function getFirstName()
	{
		return $this->record->first_name;
	}


	/** @return string */
	function getLastName()
	{
		return $this->record->last_name;
	}


	/** @return int */
	function getEmpNo()
	{
		return $this->record->emp_no;
	}


	/** @return YetORM\EntityCollection|Salary[] */
	function getSalaries()
	{
		$selection = $this->record->related('salaries', 'emp_no');
		return new YetORM\EntityCollection($selection, 'Model\Entity\Salary');
	}


	/** @return YetORM\EntityCollection|Department[] */
	function getDepartments()
	{
		$selection = $this->record->related('dept_emp', 'emp_no');
		return new YetORM\EntityCollection($selection, 'Model\Entity\Department', 'departments', 'dept_no');
	}

}
