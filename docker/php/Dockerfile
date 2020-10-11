FROM php:7.4.11-fpm

RUN apt-get update && apt-get install -y libpq-dev && docker-php-ext-install pdo pdo_pgsql
RUN apt install -y unzip;
RUN cd ~
RUN curl -sS https://getcomposer.org/installer -o composer-setup.php
RUN php composer-setup.php --install-dir=/usr/local/bin --filename=composer
RUN export COMPOSER_HOME=~/.composer

COPY entrypoint.sh /usr/local/bin/custom-entrypoint.sh
RUN chmod 775 /usr/local/bin/custom-entrypoint.sh
ENTRYPOINT ["/bin/bash", "/usr/local/bin/custom-entrypoint.sh"]

