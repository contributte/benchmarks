<?php

use Psr\Http\Message\ServerRequestInterface;
use React\Http\HttpServer;
use React\Http\Message\Response;
use React\Socket\SocketServer;

require __DIR__ . '/vendor/autoload.php';

$http = new HttpServer(static function (ServerRequestInterface $request) {
	echo "Request received {$request->getUri()}" . PHP_EOL;

	return Response::json([
		'time' => time(),
		'memory' => memory_get_usage() / 1024 / 1024 . 'MB',
		'memory_peak' => memory_get_peak_usage() / 1024 / 1024 . 'MB',
		'php' => PHP_VERSION,
		'webserver' => 'ReactPHP',
		'manager' => 'ReactPHP',
	]);
});

$socket = new SocketServer('0.0.0.0:8000');
$http->listen($socket);

echo "Listening on {$socket->getAddress()}" . PHP_EOL;
