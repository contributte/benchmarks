<?php

namespace Model;

use Nextras\Orm\Mapper\Mapper;

class SalariesMapper extends Mapper
{

	protected function createStorageReflection()
	{
		$reflection = parent::createStorageReflection();
		$reflection->addMapping('employee', 'emp_no');

		return $reflection;
	}

}
