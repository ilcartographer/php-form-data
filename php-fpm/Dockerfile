FROM ubuntu:14.04

ENV DEBIAN_FRONTEND noninteractive

RUN apt-get update && apt-get install -y \
    php5-cli \
    php5-fpm \
    php5-json \
    php5-intl \
    php5-xdebug \
  && usermod -u 1000 www-data

RUN yes | apt-get install pdftk

ADD conf/xdebug.ini ${PHP_INI_DIR}/conf.d/20-xdebug.ini

ADD start.sh /start.sh

EXPOSE 9000

WORKDIR /var/www

ENTRYPOINT ["/start.sh"]
