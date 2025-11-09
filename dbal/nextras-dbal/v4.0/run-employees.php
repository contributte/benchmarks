<?php

use Nextras\Dbal\Connection;
use Nextras\Dbal\Drivers\Mysqli\MysqliDriver;

require_once __DIR__ . '/../../bootstrap.php';

Bootstrap::php('NextrasDbal (~4.0)', '>=', '7.4.0');
Bootstrap::init();
Bootstrap::check(__DIR__);

$config = Bootstrap::$config['db'];
$connection = new Connection([
	'driver' => MysqliDriver::class,
	'host' => 'localhost',
	'database' => $config['dbname'],
	'username' => $config['user'],
	'password' => $config['password'],
]);

$startTime = -microtime(TRUE);
ob_start();

$employees = $connection->query('
	SELECT emp_no, first_name, last_name
	FROM employees
	LIMIT %i', Bootstrap::$config['limit']
);

foreach ($employees as $employee) {
	echo "{$employee->first_name} {$employee->last_name} ({$employee->emp_no})\n";

	echo "Salaries:\n";
	$salaries = $connection->query('
		SELECT salary
		FROM salaries
		WHERE emp_no = %i', $employee->emp_no
	);
	foreach ($salaries as $salary) {
		echo $salary->salary, "\n";
	}

	echo "Departments:\n";
	$departments = $connection->query('
		SELECT d.dept_name
		FROM dept_emp de
		JOIN departments d ON d.dept_no = de.dept_no
		WHERE de.emp_no = %i', $employee->emp_no
	);
	foreach ($departments as $department) {
		echo $department->dept_name, "\n";
	}
}

ob_end_clean();
$endTime = microtime(TRUE);

Bootstrap::result('NextrasDbal', '~4.0', $startTime, $endTime);
