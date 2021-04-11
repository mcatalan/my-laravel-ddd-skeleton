FROM debian:9.6-slim

RUN rm /bin/sh && ln -s /bin/bash /bin/sh
RUN apt-get update && apt-get -y install wget apt-transport-https

RUN wget -O /etc/apt/trusted.gpg.d/php.gpg https://packages.sury.org/php/apt.gpg
RUN sh -c 'echo "deb https://packages.sury.org/php/ stretch main" > /etc/apt/sources.list.d/php.list'

RUN apt-get update && apt-get -y upgrade && DEBIAN_FRONTEND=noninteractive apt-get -y install \
    apache2 php8.0 php8.0-mysql libapache2-mod-php8.0 curl lynx-cur php8.0-fpm php8.0-xml php8.0-cli \
    php8.0-common php8.0-opcache php8.0-mbstring php-mcrypt php8.0-zip php-mongodb \
    php-curl supervisor vim iputils-ping php8.0-curl php8.0-gd php8.0-sqlite3

RUN php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');"
RUN php -r "if (hash_file('sha384', 'composer-setup.php') === '756890a4488ce9024fc62c56153228907f1545c228516cbf63f885e036d37e9a59d27d63f46af1d4d07ee0f76181c7d3') { echo 'Installer verified'; } else { echo 'Installer corrupt'; unlink('composer-setup.php'); } echo PHP_EOL;"
RUN php composer-setup.php
RUN php -r "unlink('composer-setup.php');"

# Enable apache mods.
RUN a2enmod php8.0
RUN a2enmod rewrite
RUN a2enmod headers

RUN service apache2 stop
RUN service apache2 start

CMD apachectl -D FOREGROUND
