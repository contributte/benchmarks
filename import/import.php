<?php

set_time_limit(0);
ini_set('memory_limit', '512M');

use Nette\Database\Connection;
use Nette\Database\Helpers;

if (@!include __DIR__ . '/data.sql') {
    echo 'Extract db/employees.sql.7z to import/data.sql';
    exit(1);
}

require_once __DIR__ . '/../bootstrap.php';

Bootstrap::init();
Bootstrap::check(__DIR__);

$connection = new Connection(
    Bootstrap::$config['db']['driver'] . ':dbname=' . Bootstrap::$config['db']['dbname'],
    Bootstrap::$config['db']['user'],
    Bootstrap::$config['db']['password']
);

if (($count = Helpers::loadFromFile($connection, __DIR__ . '/data.sql')) > 0) {
    echo "OK ($count commands executed) \n";
} else {
    echo "FAILED \n";
}

