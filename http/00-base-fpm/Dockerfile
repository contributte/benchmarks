FROM benchmark/http:base

RUN apt-get update && \
	apt-get install -y php8.2-fpm && \
	apt-get clean -y && apt-get autoclean -y && apt-get autoremove -y && \
	rm -rf /var/lib/apt/lists/* /var/lib/log/* /tmp/* /var/tmp/*

COPY php-fpm.conf /etc/php/8.2/php-fpm.conf
