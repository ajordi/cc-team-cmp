#!/bin/bash

set -Eeuo pipefail

cat > /usr/local/etc/php/conf.d/xdebug.ini << __EOF__
zend_extension=xdebug.so
xdebug.remote_enable=1
xdebug.remote_handler=dbgp
xdebug.remote_port=9000
xdebug.remote_autostart=1
xdebug.remote_connect_back=​0
xdebug.idekey=docker
xdebug.remote_host=${XDEBUG_REMOTE_HOST}
xdebug.profiler_enable=0
xdebug.profiler_enable_trigger=1
xdebug.profiler_output_dir=/opt/app/storage/logs
__EOF__

composer install --no-interaction

composer clear-cache

exec php-fpm -F
