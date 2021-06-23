FROM rafaellessa/php_7-3_apache
LABEL Name="Food Service"
LABEL Version="1.0.0"

RUN chown -R www-data:www-data /var/www

USER root

COPY app.entrypoint.sh /usr/local/bin/
RUN chmod 0755 /usr/local/bin/app.entrypoint.sh

WORKDIR /var/www

ENTRYPOINT ["app.entrypoint.sh"]
CMD ["apache2-foreground"]
