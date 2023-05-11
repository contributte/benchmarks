<?php

use Amp\Http\Server\Request;
use Amp\Http\Server\RequestHandler\CallableRequestHandler;
use Amp\Http\Server\Response;
use Amp\Http\Server\Server;
use Amp\Http\Status;
use Amp\Loop;
use Amp\Socket;
use Psr\Log\NullLogger;

require __DIR__ . '/vendor/autoload.php';

Loop::run(function () {
	$sockets = [
		Socket\listen("0.0.0.0:8000"),
	];

	$server = new Server($sockets, new CallableRequestHandler(static function (Request $request) {
		echo "Request received {$request->getUri()}" . PHP_EOL;

		return new Response(
			Status::OK,
			['Content-type' => 'application/json'],
			json_encode([
				'time' => time(),
				'memory' => memory_get_usage() / 1024 / 1024 . 'MB',
				'memory_peak' => memory_get_peak_usage() / 1024 / 1024 . 'MB',
				'php' => PHP_VERSION,
				'webserver' => 'Amphp',
				'manager' => 'Amphp',
			]));
	}), new NullLogger);

	echo "Listening on 0.0.0.0:8000" . PHP_EOL;

	yield $server->start();
});
