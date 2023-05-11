<?php

use OpenSwoole\Http\Request;
use OpenSwoole\Http\Response;
use OpenSwoole\Http\Server;

require_once __DIR__ . '/vendor/autoload.php';

$server = new Server("0.0.0.0", 8000);

$server->on("Start", function (Server $server) {
	echo "OpenSwoole http server is started at http://0.0.0.0:8000\n";
});

$server->on("Request", function (Request $request, Response $response) {
	echo "Request received {$request->server['request_uri']}" . PHP_EOL;

	$response->header("Content-Type", "application/json");
	$response->end(json_encode([
		'time' => time(),
		'memory' => memory_get_usage() / 1024 / 1024 . 'MB',
		'memory_peak' => memory_get_peak_usage() / 1024 / 1024 . 'MB',
		'php' => PHP_VERSION,
		'webserver' => 'OpenSwoole',
		'manager' => 'OpenSwoole',
	]));
});

$server->start();
