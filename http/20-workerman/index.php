<?php

use Workerman\Connection\TcpConnection;
use Workerman\Protocols\Http\Request;
use Workerman\Protocols\Http\Response;
use Workerman\Worker;

require_once __DIR__ . '/vendor/autoload.php';

$worker = new Worker('http://0.0.0.0:8000');

$worker->count = 4;

$worker->onMessage = function (TcpConnection $connection, Request $request) {
	echo "Request received {$request->uri()}" . PHP_EOL;

	$connection->send(
		new Response(
			200,
			[
				'Content-type' => 'application/json',
			],
			json_encode([
				'time' => time(),
				'memory' => memory_get_usage() / 1024 / 1024 . 'MB',
				'memory_peak' => memory_get_peak_usage() / 1024 / 1024 . 'MB',
				'php' => PHP_VERSION,
				'webserver' => 'Workerman',
				'manager' => 'Workerman',
			])
		)
	);
};

echo "Listening on {$worker->getSocketName()}" . PHP_EOL;
Worker::runAll();


