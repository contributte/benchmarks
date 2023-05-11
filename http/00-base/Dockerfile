FROM debian:bullseye-slim

RUN apt-get update && \
	apt-get dist-upgrade -y && \
	apt-get install -y \
		wget \
		curl \
		apt-transport-https \
		ca-certificates \
		unzip \
		tini && \
	wget -O /etc/apt/trusted.gpg.d/php.gpg https://packages.sury.org/php/apt.gpg && \
	echo "deb https://packages.sury.org/php/ bullseye main" > /etc/apt/sources.list.d/php.list && \
	apt-get update && apt-get install -y \
		git \
		php8.2-cli \
		php8.2-dev \
		php8.2-mbstring \
		php8.2-tokenizer \
		php8.2-zip && \
	apt-get clean -y && apt-get autoclean -y && apt-get autoremove -y && \
	rm -rf /var/lib/apt/lists/* /var/lib/log/* /tmp/* /var/tmp/*

COPY 800-php.ini /etc/php/8.2/conf.d/800-php.ini
COPY 800-php.ini /etc/php/8.2/cli/conf.d/800-php.ini

WORKDIR /srv

ENTRYPOINT ["/usr/bin/tini", "--", "/entrypoint.sh"]
