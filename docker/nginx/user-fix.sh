userdel -f www-data &&\
if getent group www-data ; then groupdel www-data; fi &&\
groupadd -g ${PGID} www-data &&\
useradd -l -u ${PUID} -g www-data www-data &&\
install -d -m 0755 -o www-data -g www-data /home/www-data &&\

chsh -s /bin/bash www-data
