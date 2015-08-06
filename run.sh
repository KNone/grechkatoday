#!/bin/bash

DIR=$( cd "$( dirname "${BASH_SOURCE[0]}" )" && pwd )

git pull

curl -sS https://getcomposer.org/installer | php
php composer.phar install --optimize-autoloader

sudo ip addr add 10.2.0.1/8 dev lo

sudo docker-compose up -d grechkatoday
