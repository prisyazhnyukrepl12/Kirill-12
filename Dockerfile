FROM ubuntu:latest

ENV TZ=Europe/London

RUN ln -sf /usr/share/zoneinfo/$TZ /etc/localtime && echo $TZ > /etc/timezone

RUN apt-get update && apt-get install -y \
    apache2 \
    php \
    libapache2-mod-php \
    php-mysql \
    && apt-get clean \
    && rm -rf /var/lib/apt/lists/*

RUN rm -rf /var/www/html/*

COPY ./ /var/www/html
RUN chown -R www-data:www-data /var/www/html/

RUN a2enmod rewrite

EXPOSE 80

CMD ["apache2ctl", "-D", "FOREGROUND"]