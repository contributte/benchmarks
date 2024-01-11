#!/usr/bin/env bash
set -Eeox pipefail

if [ -n "$OPCACHE" ]; then
	./vendor/bin/phpbench run tests --report=default --php-config='{"opcache.enable": 1, "opcache.enable_cli": 1}'
else
	./vendor/bin/phpbench run tests --report=default
fi
