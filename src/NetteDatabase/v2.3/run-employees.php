<?php

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

foreach ($context->table('employees')->limit(Bootstrap::$config['limit']) as $employe) {
	echo "$employe->first_name $employe->last_name ($employe->emp_no)\n";

	echo "Salaries:\n";
	foreach ($employe->related('salaries') as $salary) {
		echo $salary->salary, "\n";
	}

	echo "Departments:\n";
	foreach ($employe->related('dept_emp') as $department) {
		echo $department->dept->dept_name, "\n";
	}
}

ob_end_clean();
$endTime = microtime(TRUE);

Bootstrap::result('NetteDatabase', '~2.3.0', $startTime, $endTime);
