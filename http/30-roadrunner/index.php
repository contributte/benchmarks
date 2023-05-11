<?php

use Nyholm\Psr7\Factory\Psr17Factory;
use Nyholm\Psr7\Response;
use Spiral\RoadRunner\Http\PSR7Worker;
use Spiral\RoadRunner\Worker;

include "vendor/autoload.php";

$worker = Worker::create();
$psrFactory = new Psr17Factory();

$worker = new PSR7Worker($worker, $psrFactory, $psrFactory, $psrFactory);

while ($req = $worker->waitRequest()) {
	try {
		$rsp = new Response(
			200,
			['Content-type' => 'application/json'],
			json_encode([
				'time' => time(),
				'memory' => memory_get_usage() / 1024 / 1024 . 'MB',
				'memory_peak' => memory_get_peak_usage() / 1024 / 1024 . 'MB',
				'php' => PHP_VERSION,
				'webserver' => 'Roadrunner',
				'manager' => 'Roadrunner',
			])
		);

		$worker->respond($rsp);
	} catch (Throwable $e) {
		$worker->getWorker()->error((string) $e);
	}
}
