FROM ghcr.io/roadrunner-server/roadrunner:2023.1.2 AS roadrunner

FROM composer:2 as php

WORKDIR /srv

COPY ./composer.json /srv/
COPY ./composer.lock /srv/

RUN composer install --ignore-platform-reqs

FROM benchmark/http:base

COPY entrypoint.sh /entrypoint.sh
COPY .rr.yaml /srv/.rr.yaml
COPY --from=roadrunner /usr/bin/rr /usr/local/bin/rr
COPY --from=php /srv/vendor /srv/vendor
COPY . /srv
