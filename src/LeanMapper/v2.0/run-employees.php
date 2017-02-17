<?php

use LeanMapper\Connection;
use LeanMapper\DefaultEntityFactory;
use Model\Mapper;
use Model\Repository\EmployeesRepository;

require_once __DIR__ . '/../../bootstrap.php';

Bootstrap::init();
Bootstrap::check(__DIR__);

$connection = new Connection([
	'username' => Bootstrap::$config['db']['user'],
	'password' => Bootstrap::$config['db']['password'],
	'database' => Bootstrap::$config['db']['dbname'],
]);

$startTime = -microtime(TRUE);
ob_start();

$entityFactory = new DefaultEntityFactory;
$mapper = new Mapper();
$employeesRepository = new EmployeesRepository($connection, $mapper, $entityFactory);

foreach ($employeesRepository->findAll(Bootstrap::$config['limit']) as $employee) {
	echo "$employee->firstName $employee->lastName ($employee->empNo)\n";
	echo "Salaries:\n";
	foreach ($employee->salaries as $salary) {
		echo $salary->salary, "\n";
	}
	echo "Departments:\n";
	foreach ($employee->departments as $department) {
		echo $department->deptName, "\n";
	}
}

ob_end_clean();
$endTime = microtime(TRUE);

Bootstrap::result('LeanMapper', '^2.2.0', $startTime, $endTime);
