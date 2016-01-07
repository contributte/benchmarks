<?php

use Model\DepartmentsMapper;
use Model\DepartmentsRepository;
use Model\EmployeesMapper;
use Model\EmployeesRepository;
use Model\SalariesMapper;
use Model\SalariesRepository;
use Nette\Caching\Storages\FileStorage;
use Nextras\Dbal\Connection;
use Nextras\Orm\Model\SimpleModelFactory;

require_once __DIR__ . '/../../bootstrap.php';

Bootstrap::init();
Bootstrap::check(__DIR__);

$cacheStorage = Bootstrap::$config['cache'] ? new FileStorage(__DIR__ . '/temp') : NULL;

$connection = new Connection([
    'driver' => Bootstrap::$config['db']['driver'] . 'i',
    'username' => Bootstrap::$config['db']['user'],
    'password' => Bootstrap::$config['db']['password'],
    'dbname' => Bootstrap::$config['db']['dbname'],
]);

$staticLoader = new SimpleModelFactory($cacheStorage, [
    'employees' => new EmployeesRepository(new EmployeesMapper($connection, $cacheStorage)),
    'salarieys' => new SalariesRepository(new SalariesMapper($connection, $cacheStorage)),
    'departments' => new DepartmentsRepository(new DepartmentsMapper($connection, $cacheStorage)),
]);


$startTime = -microtime(TRUE);
ob_start();

$model = $staticLoader->create();
$employees = $model->employees->findOverview(Bootstrap::$config['limit']);

foreach ($employees as $employee) {
    echo "$employee->firstName $employee->lastName ($employee->id)\n";

    echo "Salaries:\n";
    foreach ($employee->salaries as $salary) {
        echo $salary->salary, "\n";
    }

    echo "Departments:\n";
    foreach ($employee->departments as $department) {
        echo $department->name, "\n";
    }
}

ob_end_clean();
$endTime = microtime(TRUE);

Bootstrap::result('Nextras\Orm', '~1.0', $startTime, $endTime);
