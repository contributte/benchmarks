FROM composer:2 as php

WORKDIR /srv

COPY ./composer.json /srv/
COPY ./composer.lock /srv/

RUN composer install --ignore-platform-reqs

FROM benchmark/http:base

RUN apt-get update && \
	pecl install swoole && \
	apt-get clean -y && apt-get autoclean -y && apt-get autoremove -y && \
	rm -rf /var/lib/apt/lists/* /var/lib/log/* /tmp/* /var/tmp/*

COPY 900-php.ini /etc/php/8.2/conf.d/900-php.ini
COPY 900-php.ini /etc/php/8.2/cli/conf.d/900-php.ini
COPY entrypoint.sh /entrypoint.sh
COPY --from=php /srv/vendor /srv/vendor
COPY . /srv
