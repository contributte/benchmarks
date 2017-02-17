<?php

namespace Model\Entities;

use DateTime;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="titles")
 * @author Michael Moravec
 * @property-read Employee $employee
 * @property-read string $name
 * @property-read DateTime $fromDate
 * @property-read DateTime $toDate
 */
class Title
{

	/**
	 * @ORM\Id
	 * @ORM\ManyToOne(targetEntity="Employee", inversedBy="titles")
	 * @ORM\JoinColumn(name="emp_no", referencedColumnName="emp_no", nullable=false)
	 * @var Employee
	 */
	protected $employee;

	/**
	 * @ORM\Id
	 * @ORM\Column(type="string", name="title")
	 * @var string
	 */
	protected $name;
	/**
	 * @ORM\Id
	 * @ORM\Column(type="date", name="from_date")
	 * @var DateTime
	 */
	protected $fromDate;

	/**
	 * @ORM\Column(type="date", name="to_date")
	 * @var DateTime
	 */
	protected $toDate;

	/**
	 * @return Employee
	 */
	public function getEmployee()
	{
		return $this->employee;
	}

	/**
	 * @return string
	 */
	public function getName()
	{
		return $this->name;
	}

	/**
	 * @return DateTime
	 */
	public function getFromDate()
	{
		return $this->fromDate;
	}

	/**
	 * @return DateTime
	 */
	public function getToDate()
	{
		return $this->toDate;
	}

}
