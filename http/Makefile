############################################################
# DOCKER ###################################################
############################################################
.PHONY: build-all
build-all:
	# Webservers
	TAG=apache CONTEXT=10-apache $(MAKE) _docker-build
	TAG=caddy CONTEXT=10-caddy $(MAKE) _docker-build
	TAG=nginx CONTEXT=10-nginx $(MAKE) _docker-build
	TAG=unit CONTEXT=10-unit $(MAKE) _docker-build

	# Frameworks
	TAG=amphp CONTEXT=20-amphp $(MAKE) _docker-build
	TAG=php-server CONTEXT=20-php-server $(MAKE) _docker-build
	TAG=reactphp CONTEXT=20-reactphp $(MAKE) _docker-build
	TAG=workerman CONTEXT=20-workerman $(MAKE) _docker-build

	# Process managers
	TAG=php-pm CONTEXT=30-php-pm $(MAKE) _docker-build
	TAG=roadrunner CONTEXT=30-roadrunner $(MAKE) _docker-build

	# Extensions
	TAG=openswoole CONTEXT=40-openswoole $(MAKE) _docker-build
	TAG=swoole CONTEXT=40-swoole $(MAKE) _docker-build
	TAG=swow CONTEXT=40-swow $(MAKE) _docker-build

.PHONY: build-bases
build-bases:
	TAG=base CONTEXT=00-base $(MAKE) _docker-build
	TAG=base-fpm CONTEXT=00-base-fpm $(MAKE) _docker-build

############################################################
# BENCHMAKRS ###############################################
############################################################
run-%: TAG=$*
run-%:
	TAG=${TAG} $(MAKE) _docker-run

test-plow:
	plow -c 100 -n 10000 http://localhost:8000

test-wrk:
	wrk -c 100 -t 10 http://localhost:8000

test-hey:
	 hey -n 10000 -c 100 http://localhost:8000

############################################################
# DOCKER ###################################################
############################################################
_docker-build:
	docker buildx \
		build \
		--platform ${DOCKER_PLATFORM} \
		-t ${DOCKER_IMAGE}:${TAG} \
		./${CONTEXT}

_docker-run:
	docker run \
		-it \
		--rm \
		-p 8000:8000 \
		${DOCKER_IMAGE}:${TAG}
