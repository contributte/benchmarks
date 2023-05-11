<?php declare(strict_types = 1);

header('Content-type: application/json');

echo json_encode([
	'time' => time(),
	'memory' => memory_get_usage() / 1024 / 1024 . 'MB',
	'memory_peak' => memory_get_peak_usage() / 1024 / 1024 . 'MB',
	'php' => PHP_VERSION,
	'webserver' => 'Caddy',
	'manager' => 'PHP-FPM',
]);

exit(0);
