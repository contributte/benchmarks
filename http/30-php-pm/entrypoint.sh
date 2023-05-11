#!/usr/bin/env bash
set -Eeo pipefail

/srv/vendor/bin/ppm start -c /srv/phppm.json --cgi-path=/usr/bin/php
