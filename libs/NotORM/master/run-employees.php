<?php

use Model\NotORMStructure;

require_once __DIR__ . '/../../../bootstrap.php';

Bootstrap::init();
Bootstrap::check(__DIR__);

$connection = new PDO(
    Bootstrap::$config['db']['driver'] . ':dbname=' . Bootstrap::$config['db']['dbname'],
    Bootstrap::$config['db']['user'],
    Bootstrap::$config['db']['password']
);

$cache = Bootstrap::$config['cache'] ? new NotORM_Cache_File(__DIR__ . '/temp/notorm') : NULL;

$notorm = new NotORM(
    $connection,
    new NotORMStructure,
    $cache
);

$startTime = -microtime(TRUE);
ob_start();

foreach ($notorm->employees()->limit(Bootstrap::$config['limit']) as $employee) {
    echo "$employee[first_name] $employee[last_name] ($employee[emp_no])\n";

    echo "Salaries:\n";
    foreach ($employee->salaries() as $salary) {
        echo $salary['salary'], "\n";
    }

    echo "Departments:\n";
    foreach ($employee->dept_emp() as $relationship) {
        echo $relationship->departments['dept_name'], "\n";
    }
}

ob_end_clean();
$endTime = microtime(TRUE);

Bootstrap::result('NotORM', 'dev-master', $startTime, $endTime);

