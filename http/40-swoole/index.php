<?php

use Swoole\Http\Request;
use Swoole\Http\Response;
use Swoole\Http\Server;

$http = new Server('0.0.0.0', 8000);
$http->set(['hook_flags' => SWOOLE_HOOK_ALL]);

$http->on('request', function (Request $request, Response $response) {
	echo "Request received {$request->server['request_uri']}" . PHP_EOL;

	$response->setHeader('content-type', 'application/json');
	$response->end(json_encode([
		'time' => time(),
		'memory' => memory_get_usage() / 1024 / 1024 . 'MB',
		'memory_peak' => memory_get_peak_usage() / 1024 / 1024 . 'MB',
		'php' => PHP_VERSION,
		'webserver' => 'Swoole',
		'manager' => 'Swoole',
	]));
});

echo "Swoole http server is started at http://0.0.0.0:8000" . PHP_EOL;
$http->start();
