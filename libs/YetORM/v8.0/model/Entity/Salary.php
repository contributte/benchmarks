<?php

namespace Model\Entity;

use YetORM;


class Salary extends YetORM\Entity
{

	/** @return int */
	function getSalary()
	{
		return $this->record->salary;
	}

}
