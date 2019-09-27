FROM php:7.3-apache

WORKDIR /etc/apache2
RUN cp mods-available/rewrite.load mods-enabled/rewrite.load

RUN apt-get update && \
    apt-get install -y \
        libzip-dev \
        zip \
	git \
  && docker-php-ext-configure zip --with-libzip \
  && docker-php-ext-install mysqli pdo_mysql zip

#install composer
RUN curl -o /tmp/composer-setup.php https://getcomposer.org/installer \
&& curl -o /tmp/composer-setup.sig https://composer.github.io/installer.sig \
# Make sure we're installing what we think we're installing!
&& php -r "if (hash('SHA384', file_get_contents('/tmp/composer-setup.php')) !== trim(file_get_contents('/tmp/composer-setup.sig'))) { unlink('/tmp/composer-setup.php'); echo 'Invalid installer' . PHP_EOL; exit(1); }" \
&& php /tmp/composer-setup.php --no-ansi --install-dir=/usr/local/bin --filename=composer --snapshot \
&& rm -f /tmp/composer-setup.*

#enable mod_headers for apache
RUN a2enmod headers