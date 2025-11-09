<?php

use Cycle\Database\Config\DatabaseConfig;
use Cycle\Database\Config\MySQLDriverConfig;
use Cycle\Database\DatabaseManager;

require_once __DIR__ . '/../../bootstrap.php';

Bootstrap::php('CycleORM (~1.0)', '>=', '7.2.0');
Bootstrap::init();
Bootstrap::check(__DIR__);

$config = Bootstrap::$config['db'];
$dbal = new DatabaseManager(
	new DatabaseConfig([
		'default' => 'default',
		'databases' => [
			'default' => ['connection' => 'mysql']
		],
		'connections' => [
			'mysql' => new MySQLDriverConfig(
				connection: new \Cycle\Database\Config\MySQL\TcpConnectionConfig(
					database: $config['dbname'],
					host: 'localhost',
					port: 3306,
					user: $config['user'],
					password: $config['password'],
				),
			),
		]
	])
);

$db = $dbal->database('default');

$startTime = -microtime(TRUE);
ob_start();

$employees = $db->select()
	->from('employees')
	->columns(['emp_no', 'first_name', 'last_name'])
	->limit(Bootstrap::$config['limit'])
	->fetchAll();

foreach ($employees as $employee) {
	echo "{$employee['first_name']} {$employee['last_name']} ({$employee['emp_no']})\n";

	echo "Salaries:\n";
	$salaries = $db->select()
		->from('salaries')
		->columns(['salary'])
		->where('emp_no', '=', $employee['emp_no'])
		->fetchAll();
	foreach ($salaries as $salary) {
		echo $salary['salary'], "\n";
	}

	echo "Departments:\n";
	$departments = $db->select()
		->from('dept_emp', 'de')
		->innerJoin('departments', 'd')->on('d.dept_no', 'de.dept_no')
		->columns(['d.dept_name'])
		->where('de.emp_no', '=', $employee['emp_no'])
		->fetchAll();
	foreach ($departments as $department) {
		echo $department['dept_name'], "\n";
	}
}

ob_end_clean();
$endTime = microtime(TRUE);

Bootstrap::result('CycleORM', '~1.0', $startTime, $endTime);
