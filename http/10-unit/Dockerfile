FROM unit:1.29.1-php8.2 as unit

FROM benchmark/http:base

RUN apt-get update && \
	apt-get install -y libphp-embed libphp8.2-embed && \
	ln -sf /dev/stdout /var/log/unit.log && \
	mkdir -p /var/lib/unit/ && \
	chown www-data:www-data /var/lib/unit/ && \
	apt-get clean -y && apt-get autoclean -y && apt-get autoremove -y && \
	rm -rf /var/lib/apt/lists/* /var/lib/log/* /tmp/* /var/tmp/*

COPY --from=unit /usr/sbin/unitd /usr/sbin/
COPY --from=unit /usr/lib/unit /usr/lib/unit
COPY unit.json /var/lib/unit/conf.json
COPY entrypoint.sh /entrypoint.sh
COPY . /srv
