<?php

namespace Model\Types;

use Doctrine\DBAL\Platforms\AbstractPlatform;
use Doctrine\DBAL\Types\ConversionException;
use Doctrine\DBAL\Types\DateTimeType as DoctrineDateTimeType;
use DateTime;

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
