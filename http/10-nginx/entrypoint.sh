#!/usr/bin/env bash
set -Eeo pipefail

/usr/sbin/php-fpm8.2 -F -R -y /etc/php/8.2/php-fpm.conf &
/usr/sbin/nginx -g "daemon off;" &
wait -n
