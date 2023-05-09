<?php

namespace Model;

use NotORM_Structure_Convention;

/**
 * @author Vojtěch Kohout
 */
class NotORMStructure extends NotORM_Structure_Convention
{

	public function getPrimary($table)
	{
		if ($table === 'employees') {
			return 'emp_no';
		}
		if ($table === 'departments') {
			return 'dept_no';
		}

		return parent::getPrimary($table);
	}

	function getReferencingColumn($name, $table)
	{
		if ($table === 'employees' and $name === 'salaries') {
			return 'emp_no';
		}
		if ($table === 'employees' and $name === 'dept_emp') {
			return 'emp_no';
		}

		return parent::getReferencingColumn($name, $table);
	}

	function getReferencedColumn($name, $table)
	{
		if ($table === 'dept_emp' and $name === 'departments') {
			return 'dept_no';
		}

		return parent::getReferencedColumn($name, $table);
	}

}
