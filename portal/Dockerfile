FROM phusion/baseimage
MAINTAINER nicola.asuni@miracl.com

ENV DEBIAN_FRONTEND noninteractive
ENV TERM linux
ENV HOME /root
ENV DISPLAY :0

RUN locale-gen en_US.UTF-8
ENV LANG       en_US.UTF-8
ENV LC_ALL     en_US.UTF-8

CMD ["/sbin/my_init"]

RUN echo 'debconf debconf/frontend select Noninteractive' | debconf-set-selections \
&& sed -i "s/^exit 101$/exit 0/" /usr/sbin/policy-rc.d \
&& apt-get update \
&& apt-get install -y \
nginx \
php7.0-fpm \

&& sed -i "s/;date.timezone =.*/date.timezone = UTC/" /etc/php/7.0/fpm/php.ini \
&& echo "daemon off;" >> /etc/nginx/nginx.conf \
&& sed -i -e "s/;daemonize\s*=\s*yes/daemonize = no/g" /etc/php/7.0/fpm/php-fpm.conf \
&& sed -i "s/;cgi.fix_pathinfo=1/cgi.fix_pathinfo=0/" /etc/php/7.0/fpm/php.ini \
&& mkdir -p /var/www \
&& mkdir -p /etc/service/nginx \
&& mkdir -p /etc/service/phpfpm \

&& echo '#!/usr/bin/env bash\n\
php-fpm7.0 -c /etc/php/7.0/fpm' > /etc/service/phpfpm/run \
&& chmod +x /etc/service/phpfpm/run \

&& echo '#!/usr/bin/env bash\n\
nginx' > /etc/service/nginx/run \
&& chmod +x /etc/service/nginx/run \

&& sed -i -e "s/;clear_env\s*=\s*no/clear_env = no/g" /etc/php/7.0/fpm/pool.d/www.conf \

&& apt-get clean \
&& rm -rf /var/lib/apt/lists/* /tmp/* /var/tmp/* \

&& ln -sf /var/www/srv-idp-splist.php /var/www/index.php

ADD nginx.default /etc/nginx/sites-available/default
ADD src /var/www/

EXPOSE 80
