#!/bin/bash

DIR=$( cd "$( dirname "${BASH_SOURCE[0]}" )" && pwd )

git pull

curl -sS https://getcomposer.org/installer | php
php composer.phar install --optimize-autoloader
