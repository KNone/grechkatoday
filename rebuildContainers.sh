#!/bin/bash

sudo docker-compose -f production.yml build grechkatoday
sudo docker-compose -f production.yml build grechkatoday_mysql
