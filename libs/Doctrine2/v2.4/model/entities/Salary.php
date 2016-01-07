<?php

namespace Model\Entities;

use Doctrine\ORM\Mapping as ORM;
use DateTime;

/**
 * @ORM\Entity
 * @ORM\Table(name="salaries")
 * @author Michael Moravec
 * @property-read int $amount
 * @property-read DateTime $fromDate
 * @property-read DateTime $toDate
 */
class Salary
{

	/**
	 * @ORM\Id
	 * @ORM\ManyToOne(targetEntity="Employee", inversedBy="salaries")
	 * @ORM\JoinColumn(name="emp_no", referencedColumnName="emp_no", nullable=false)
	 * @var Employee
	 */
	protected $employee;

	/**
	 * @ORM\Column(type="integer", name="salary")
	 * @var int
	 */
	protected $amount;

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
	 * @return int
	 */
	public function getAmount()
	{
		return $this->amount;
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
