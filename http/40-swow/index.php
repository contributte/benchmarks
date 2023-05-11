<?php

use Swow\Coroutine;
use Swow\CoroutineException;
use Swow\Errno;
use Swow\Http\Protocol\ProtocolException;
use Swow\Psr7\Message\Response;
use Swow\Psr7\Psr7;
use Swow\Psr7\Server\Server;
use Swow\SocketException;
use function Swow\Sync\waitAll;

require_once __DIR__ . '/vendor/autoload.php';

$server = new Server();
$server->bind('0.0.0.0', 8000);
$server->listen();

echo "Swow http server is started at http://0.0.0.0:8000\n";

Coroutine::run(function () use ($server) {
	while (true) {
		try {
			$connection = $server->acceptConnection();
			Coroutine::run(function () use ($connection) {
				try {
					while (true) {
						$request = null;
						try {
							$request = $connection->recvHttpRequest();
							echo "Request received {$request->getUri()}" . PHP_EOL;

							$response = new Response();
							$response->setStatus(200);
							$response->setHeader('Content-type', 'application/json');
							$response->getBody()->write(json_encode([
								'time' => time(),
								'memory' => memory_get_usage() / 1024 / 1024 . 'MB',
								'memory_peak' => memory_get_peak_usage() / 1024 / 1024 . 'MB',
								'php' => PHP_VERSION,
								'webserver' => 'Swow',
								'manager' => 'Swow',
							]));

							$connection->sendHttpResponse($response);
						} catch (ProtocolException $exception) {
							$connection->error($exception->getCode(), $exception->getMessage());
						}
						if (!$request || !Psr7::detectShouldKeepAlive($request)) {
							break;
						}
					}
				} catch (Throwable $exception) {
					echo $exception->getMessage() . PHP_EOL;
				} finally {
					$connection->close();
				}
			});
		} catch (SocketException|CoroutineException $exception) {
			if (in_array($exception->getCode(), [Errno::EMFILE, Errno::ENFILE, Errno::ENOMEM], true)) {
				echo "Socket resources have been exhausted." . PHP_EOL;
				sleep(1);
			} else {
				echo $exception->getMessage() . PHP_EOL;
				break;
			}
		} catch (Throwable $exception) {
			echo $exception->getMessage() . PHP_EOL;
		}
	}
});
waitAll();
