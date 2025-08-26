FROM ubuntu:latest

ENV TZ=Europe/London

RUN ln -sf /usr/share/zoneinfo/$TZ /etc/localtime && echo $TZ > /etc/timezone

RUN apt-get update && apt-get -y install apache2 php libapache2-mod-php php-mysql

RUN rm -rf /var/www/html/*
COPY ./ /var/www/html
RUN chown -R www-data:www-data /var/www/html/

RUN a2enmod rewrite

EXPOSE 80

CMD ["apache2ctl", "-D", "FOREGROUND"]