FROM benchmark/http:base-fpm

RUN apt-get update && \
	echo "deb [trusted=yes] https://apt.fury.io/caddy/ /" > /etc/apt/sources.list.d/caddy-fury.list && \
	apt-get update && \
	apt-get install -y caddy && \
	apt-get clean -y && apt-get autoclean -y && apt-get autoremove -y && \
	rm -rf /var/lib/apt/lists/* /var/lib/log/* /tmp/* /var/tmp/*

COPY Caddyfile /etc/Caddyfile
COPY entrypoint.sh /entrypoint.sh
COPY . /srv

WORKDIR /srv

ENTRYPOINT ["/usr/bin/tini", "--", "/entrypoint.sh"]
