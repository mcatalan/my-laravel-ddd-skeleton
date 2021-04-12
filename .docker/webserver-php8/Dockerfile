FROM debian:9.6-slim

RUN rm /bin/sh && ln -s /bin/bash /bin/sh
RUN apt-get update && apt-get -y install wget apt-transport-https

RUN wget -O /etc/apt/trusted.gpg.d/php.gpg https://packages.sury.org/php/apt.gpg
RUN sh -c 'echo "deb https://packages.sury.org/php/ stretch main" > /etc/apt/sources.list.d/php.list'

RUN apt-get update && apt-get -y upgrade && DEBIAN_FRONTEND=noninteractive apt-get -y install \
    apache2 php8.0 php8.0-mysql libapache2-mod-php8.0 curl lynx-cur php8.0-fpm php8.0-xml php8.0-cli \
    php8.0-common php8.0-opcache php8.0-mbstring php-mcrypt php8.0-zip php-mongodb \
    php-curl supervisor vim iputils-ping php8.0-curl php8.0-gd php8.0-sqlite3

# Enable apache mods.
RUN a2enmod php8.0
RUN a2enmod rewrite
RUN a2enmod headers

RUN service apache2 stop
RUN service apache2 start

CMD apachectl -D FOREGROUND

RUN curl -sS https://getcomposer.org/installer -o composer-setup.php
RUN php composer-setup.php --install-dir=/usr/local/bin --filename=composer
