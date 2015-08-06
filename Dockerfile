FROM debian:jessie

RUN apt-get update

RUN apt-get install -y \
  nginx \
  php5-fpm \
  php5-cli \
  php5-intl \
  php5-apcu

RUN apt-get install -y \
  nano \
  sudo \
  htop

ENV TERM xterm

RUN usermod -u 1000 www-data

RUN mkdir -p /etc/nginx/sites-available/
ADD build/nginx/grechkatoday.conf /etc/nginx/sites-available/
ADD build/nginx/nginx.conf /etc/nginx/
RUN mkdir -p /etc/nginx/sites-enabled/
RUN ln -s /etc/nginx/sites-available/knone.conf /etc/nginx/sites-enabled/grechkatoday.conf

CMD service php5-fpm restart && service nginx stop && nginx
