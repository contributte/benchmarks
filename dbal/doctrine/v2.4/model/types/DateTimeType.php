<?php

namespace Model\Types;

use DateTime;
use Doctrine\DBAL\Platforms\AbstractPlatform;
use Doctrine\DBAL\Types\DateTimeType as DoctrineDateTimeType;

/**
 * @author Michael Moravec
 */
class DateTimeType extends DoctrineDateTimeType
{

	public function convertToPHPValue($value, AbstractPlatform $platform)
	{
		if ($value === NULL) {
			return NULL;
		} elseif ($value instanceof DateTime) {
			return $value->format('Y-m-d H:i:s');
		}
	}
}
