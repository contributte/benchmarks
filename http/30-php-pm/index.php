<?php

namespace PHPPM\Bridges;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use RingCentral\Psr7\Response;

require_once __DIR__ . '/vendor/autoload.php';

class AppBridge implements BridgeInterface
{
	/**
	 * {@inheritdoc}
	 */
	public function bootstrap($appBootstrap, $appenv, $debug)
	{
		// empty
	}

	/**
	 * {@inheritdoc}
	 */
	public function handle(ServerRequestInterface $request): ResponseInterface
	{
		return new Response(
			200,
			['Content-type' => 'application/json'],
			json_encode([
				'time' => time(),
				'memory' => memory_get_usage() / 1024 / 1024 . 'MB',
				'memory_peak' => memory_get_peak_usage() / 1024 / 1024 . 'MB',
				'php' => PHP_VERSION,
				'webserver' => 'PHP-PM',
				'manager' => 'PHP-PM',
			])
		);
	}

}
