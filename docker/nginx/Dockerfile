FROM nginx:latest

COPY user-fix.sh /docker-entrypoint.d/user-fix.sh
RUN chmod 775 /docker-entrypoint.d/user-fix.sh
#CMD ["/bin/bash", "/home/www-data/entrypoint.sh"]

