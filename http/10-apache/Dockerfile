FROM benchmark/http:base-fpm

RUN apt-get update && \
	apt-get install -y apache2 libapache2-mod-fcgid && \
	rm -rf /etc/apache2/sites-enabled/000-default.conf && \
	sed -i 's/Listen 80/Listen 80\nListen 8000/' /etc/apache2/ports.conf && \
	a2dismod mpm_prefork && \
	a2enmod mpm_event proxy_fcgi setenvif && \
	apt-get clean -y && apt-get autoclean -y && apt-get autoremove -y && \
	rm -rf /var/lib/apt/lists/* /var/lib/log/* /tmp/* /var/tmp/*

COPY site.conf /etc/apache2/sites-enabled/site.conf
COPY entrypoint.sh /entrypoint.sh
COPY . /srv
