#!/usr/bin/env sh
PROCESSOR=`cat /proc/cpuinfo | grep "model name" | head -n 1 | cut -d":" -f 2 | xargs`
CPU=`cat /proc/cpuinfo | grep "cpu MHz" | head -n 1 | cut -d":" -f 2 | xargs`
RAM=`cat /proc/meminfo | grep "MemTotal" | head -n 1 | cut -d":" -f 2 | xargs`

echo "Processor: ${PROCESSOR} | CPU: ${CPU} | RAM: ${RAM}"