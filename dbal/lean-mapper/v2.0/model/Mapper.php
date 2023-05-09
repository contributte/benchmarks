<?php

namespace Model;

use LeanMapper\DefaultMapper;
use LeanMapper\Row;

/**
 * @author Vojtěch Kohout
 */
class Mapper extends DefaultMapper
{

	public function getPrimaryKey($table)
	{
		if ($table === 'employees') {
			return 'emp_no';
		}
		if ($table === 'departments') {
			return 'dept_no';
		}

		return parent::getPrimaryKey($table);
	}

	public function getEntityClass($table, Row $row = NULL)
	{
		if ($table === 'salaries') {
			return $this->defaultEntityNamespace . '\Salary';
		}
		if ($table === 'departments') {
			return $this->defaultEntityNamespace . '\Department';
		}
		if ($table === 'employees') {
			return $this->defaultEntityNamespace . '\Employee';
		}

		return parent::getEntityClass($table, $row);
	}

}
