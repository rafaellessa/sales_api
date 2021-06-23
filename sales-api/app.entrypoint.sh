#!/bin/sh

chgrp -R www-data /var/www

# app
cd /var/www/html
composer clear-cache
composer install

# web server process write permission
chmod 775 -R vendor
chgrp -R www-data vendor
chmod 775 storage
chgrp www-data storage
chmod 775 bootstrap/cache
chgrp -R www-data bootstrap/cache

# Torna a pasta storage publica
php artisan storage:link
#php artisan migrate:fresh --seed

apt-get -y install iputils-ping

# PHP Xdebug
ping -c 2 -w 3 host.docker.internal > /dev/null 2>&1
if [ $? -ne 0 ]
then
    echo "Configure xdebug host..."
    echo "`hostname -i | sed -e 's/\.[[:digit:]]\+$/\.1/'` host.docker.internal" >> /etc/hosts
fi

cd /var/www

#
# original entrypoint script
#

# first arg is `-f` or `--some-option`
if [ "${1#-}" != "$1" ]; then
	set -- apache2-foreground "$@"
fi

exec "$@"
