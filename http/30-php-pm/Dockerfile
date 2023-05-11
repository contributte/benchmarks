FROM composer:2 as php

WORKDIR /srv

COPY . /srv
COPY ./composer.json /srv/
COPY ./composer.lock /srv/

RUN composer install --ignore-platform-reqs

FROM benchmark/http:base

COPY entrypoint.sh /entrypoint.sh
COPY --from=php /srv/vendor /srv/vendor
COPY . /srv
