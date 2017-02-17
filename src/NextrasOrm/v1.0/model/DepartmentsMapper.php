<?php

namespace Model;

use Nextras\Orm\Mapper\Mapper;

class DepartmentsMapper extends Mapper
{

	protected function createStorageReflection()
	{
		$reflection = parent::createStorageReflection();
		$reflection->addMapping('id', 'dept_no');
		$reflection->addMapping('name', 'dept_name');

		return $reflection;
	}

}
