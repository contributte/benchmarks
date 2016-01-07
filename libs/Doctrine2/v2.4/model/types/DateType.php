<?php

namespace Model\Types;

use Doctrine\DBAL\Platforms\AbstractPlatform;
use Doctrine\DBAL\Types\ConversionException;
use Doctrine\DBAL\Types\DateType as DoctrineDateType;
use Nette\Utils\DateTime as NetteDateTime;

/**
 * @author Michael Moravec
 */
class DateType extends DoctrineDateType
{
	public function convertToPHPValue($value, AbstractPlatform $platform)
	{
		if ($value === NULL) {
			return NULL;
		} elseif ($value instanceof DateTime) {
			return $value->format('Y-m-d');
		}
	}
}
