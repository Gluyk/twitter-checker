FROM php:7.4-fpm-alpine

RUN apk update \
	&& apk upgrade \
	&& apk add composer tini \
	&& docker-php-ext-install pdo_mysql \
	&& rm -rf /var/cache/apk/*

WORKDIR /app
RUN echo "*       *       *       *       *       run-parts /etc/periodic/1min" >> /etc/crontabs/root

ENTRYPOINT ["/sbin/tini", "--"]
CMD ["/usr/sbin/crond", "-f"]
