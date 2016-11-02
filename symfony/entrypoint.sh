#!/bin/bash

rm -rf /var/www/var/cache/*
/bin/bash -l -c "$*"
