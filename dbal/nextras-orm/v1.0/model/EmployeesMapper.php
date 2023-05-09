<?php

namespace Model;

use Nextras\Orm\Entity\Reflection\PropertyMetadata;
use Nextras\Orm\Mapper\IMapper;
use Nextras\Orm\Mapper\Mapper;

class EmployeesMapper extends Mapper
{

	protected function createStorageReflection()
	{
		$reflection = parent::createStorageReflection();
		$reflection->addMapping('id', 'emp_no');

		return $reflection;
	}

	public function getManyHasManyParameters(PropertyMetadata $sourceProperty, IMapper $targetMapper)
	{
		if ($targetMapper instanceof DepartmentsMapper) {
			return ['dept_emp', ['emp_no', 'dept_no']];
		}

		return parent::getManyHasManyParameters($sourceProperty, $$targetMapper);
	}

}
