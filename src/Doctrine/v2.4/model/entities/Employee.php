<?php

namespace Model\Entities;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use DateTime;

/**
 * @ORM\Entity
 * @ORM\Table(name="employees")
 */
class Employee
{
	/**
	 * @ORM\Column(type="integer", name="emp_no")
	 * @ORM\Id
	 * @var int
	 */
	protected $id;

	/**
	 * @ORM\Column(type="date", name="birth_date")
	 * @var DateTime
	 */
	protected $birthDate;

	/**
	 * @ORM\Column(name="first_name")
	 * @var string
	 */
	protected $firstName;

	/**
	 * @ORM\Column(name="last_name")
	 * @var string
	 */
	protected $lastName;

	/**
	 * @ORM\Column(name="gender")
	 * @var string
	 */
	protected $gender;

	/**
	 * @ORM\Column(type="date", name="hire_date")
	 * @var DateTime
	 */
	protected $hireDate;

	/**
	 * @ORM\OneToMany(targetEntity="Title", mappedBy="employee", fetch="EXTRA_LAZY")
	 * @var Collection|Title[]
	 */
	protected $titles;

	/**
	 * @ORM\OneToMany(targetEntity="DepartmentEmployee", mappedBy="employee", fetch="EXTRA_LAZY")
	 * @var Collection|DepartmentEmployee[]
	 */
	protected $affiliatedDepartments;

	/**
	 * @ORM\OneToMany(targetEntity="DepartmentManager", mappedBy="employee", fetch="EXTRA_LAZY")
	 * @var Collection|DepartmentManager[]
	 */
	protected $managedDepartments;

	/**
	 * @ORM\OneToMany(targetEntity="Salary", mappedBy="employee", fetch="EXTRA_LAZY")
	 * @var Collection|Salary[]
	 */
	protected $salaries;

	public function __construct()
	{
		$this->titles = new ArrayCollection();
		$this->affiliatedDepartments = new ArrayCollection();
		$this->managedDepartments = new ArrayCollection();
		$this->salaries = new ArrayCollection();
	}

	/**
	 * @return int
	 */
	public function getId()
	{
		return $this->id;
	}

	/**
	 * @return DateTime
	 */
	public function getBirthDate()
	{
		return $this->birthDate;
	}

	/**
	 * @return string
	 */
	public function getFirstName()
	{
		return $this->firstName;
	}

	/**
	 * @return string
	 */
	public function getLastName()
	{
		return $this->lastName;
	}

	/**
	 * @return string
	 */
	public function getGender()
	{
		return $this->gender;
	}

	/**
	 * @return DateTime
	 */
	public function getHireDate()
	{
		return $this->hireDate;
	}

	/**
	 * @return Collection|Title[]
	 */
	public function getTitles()
	{
		return $this->titles;
	}

	/**
	 * @return Collection|DepartmentEmployee[]
	 */
	public function getAffiliatedDepartments()
	{
		return $this->affiliatedDepartments;
	}

	/**
	 * @return Collection|DepartmentManager[]
	 */
	public function getManagedDepartments()
	{
		return $this->managedDepartments;
	}

	/**
	 * @return Collection|Salary[]
	 */
	public function getSalaries()
	{
		return $this->salaries;
	}

}
