echo "TEST vooleeee"
if [ ${PUID:-0} -ne 0 ] && [ ${PGID:-0} -ne 0 ]; then \
    userdel -f www-data &&\
    if getent group www-data ; then groupdel www-data; fi &&\
    groupadd -g ${PGID} www-data &&\
    useradd -l -u ${PUID} -g www-data www-data &&\
    install -d -m 0755 -o www-data -g www-data /home/www-data &&\
    chown --changes --silent --no-dereference --recursive \
          --from=33:33 ${PUID}:${PGID} \
        /home/www-data \
        /.composer \
        /var/run/php-fpm \
        /var/lib/php/sessions \
;fi

chsh -s /bin/bash www-data

php-fpm --nodaemonize --fpm-config /usr/local/etc/php-fpm.conf
