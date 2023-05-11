FROM benchmark/http:base-fpm

RUN apt-get update && \
	wget -O- http://nginx.org/keys/nginx_signing.key | apt-key add - && \
	echo "deb http://nginx.org/packages/debian/ bullseye nginx" > /etc/apt/sources.list.d/nginx.list && \
	echo "deb-src http://nginx.org/packages/debian/ bullseye nginx" >> /etc/apt/sources.list.d/nginx.list && \
	apt-get update && \
	apt-get install -y nginx && \
	apt-get clean -y && apt-get autoclean -y && apt-get autoremove -y && \
	rm -rf /var/lib/apt/lists/* /var/lib/log/* /tmp/* /var/tmp/*

COPY nginx.conf /etc/nginx/nginx.conf
COPY entrypoint.sh /entrypoint.sh
COPY . /srv
