#!/usr/bin/env bash
set -Eeox pipefail

./benchmark.sh
OPCACHE=1 ./benchmark.sh
