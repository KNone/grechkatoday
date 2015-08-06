#!/bin/bash

sudo ip addr add 10.2.0.1/8 dev lo

sudo docker-compose up -d grechkatoday
