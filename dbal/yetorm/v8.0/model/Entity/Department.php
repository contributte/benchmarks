<?php

namespace Model\Entity;

use YetORM;


class Department extends YetORM\Entity
{

	/** @return string */
	function getName()
	{
		return $this->record->dept_name;
	}

}
