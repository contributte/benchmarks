<?php

use Model\Repository\EmployeeRepository;
use Nette\Caching\Storages\FileStorage;
use Nette\Database\Connection;
use Nette\Database\Context;
use Nette\Database\Conventions\DiscoveredConventions;
use Nette\Database\Structure;

require_once __DIR__ . '/../../bootstrap.php';

Bootstrap::init();
Bootstrap::check(__DIR__);

$cacheStorage = Bootstrap::$config['cache'] ? new FileStorage(__DIR__ . '/temp') : NULL;

$connection = new Connection(
    Bootstrap::$config['db']['driver'] . ':dbname=' . Bootstrap::$config['db']['dbname'],
    Bootstrap::$config['db']['user'],
    Bootstrap::$config['db']['password']
);

$structure = new Structure($connection, $cacheStorage);
$conventions = new DiscoveredConventions($structure);
$context = new Context($connection, $structure, $conventions, $cacheStorage);

$startTime = -microtime(TRUE);
ob_start();
$employees = new EmployeeRepository($context);

foreach ($employees->findAll()->limit(Bootstrap::$config['limit']) as $employee) {
    echo $employee->getFirstName(), ' ', $employee->getLastName(), ' (', $employee->getEmpNo(), ")\n";

    echo 'Salaries:', "\n";
    foreach ($employee->getSalaries() as $salary) {
        echo $salary->getSalary(), "\n";
    }

    echo 'Departments:', "\n";
    foreach ($employee->getDepartments() as $department) {
        echo $department->getName(), "\n";
    }
}

ob_end_clean();
$endTime = microtime(TRUE);

Bootstrap::result('YetORM', '^8.0.0', $startTime, $endTime);
