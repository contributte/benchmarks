<?php

use Doctrine\Common\Cache\FilesystemCache;
use Doctrine\DBAL\Types\Type;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Tools\Pagination\Paginator;
use Doctrine\ORM\Tools\Setup;

require_once __DIR__ . '/../../bootstrap.php';

Bootstrap::init();
Bootstrap::check(__DIR__);

$cache = Bootstrap::$config['cache'] ? new FilesystemCache(__DIR__ . '/temp') : NULL;
$config = Setup::createAnnotationMetadataConfiguration(
    [__DIR__ . '/model/entities'],
    TRUE,
    __DIR__ . '/temp/proxies',
    $cache,
    FALSE
);
$config->setProxyNamespace('Model\Entities\Proxies');
$config->setAutoGenerateProxyClasses(TRUE);


// we need __toString on DateTime, since UoW converts composite primary keys to string
// (who the hell invented composite PKs :P)
Type::overrideType(Type::DATE, 'Model\Types\DateType');
Type::overrideType(Type::DATETIME, 'Model\Types\DateTimeType');

$em = EntityManager::create([
    'driver' => Bootstrap::$config['db']['driverpdo'],
    'user' => Bootstrap::$config['db']['user'],
    'password' => Bootstrap::$config['db']['password'],
    'dbname' => Bootstrap::$config['db']['dbname'],
],
    $config
);


$startTime = -microtime(TRUE);
ob_start();

$qb = $em->createQueryBuilder()
    ->from('Model\Entities\Employee', 'e')
    ->select('e')
    ->innerJoin('e.salaries', 's')
    ->addSelect('s')
    ->innerJoin('e.affiliatedDepartments', 'd')
    ->addSelect('d')
    ->innerJoin('d.department', 'dd')
    ->addSelect('dd')
    ->setMaxResults(Bootstrap::$config['limit'])
    ->getQuery();

$paginator = new Paginator($qb);

foreach ($paginator->getIterator() as $employee) {
    echo $employee->getFirstName(), ' ', $employee->getLastName(), ' (', $employee->getId(), ")\n";

    echo "Salaries:\n";
    foreach ($employee->getSalaries() as $salary) {
        echo $salary->getAmount() . "\n";
    }

    echo "Departments:\n";
    foreach ($employee->getAffiliatedDepartments() as $department) {
        echo $department->getDepartment()->getName() . "\n";
    }
}

ob_end_clean();
$endTime = microtime(TRUE);

Bootstrap::result('Doctrine2', '^2.4.0', $startTime, $endTime);
