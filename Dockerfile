FROM wordpress:latest

# Install SSL certificates
RUN apt-get update && \
    apt-get install -y ca-certificates && \
    update-ca-certificates

# Create PHP mysqli configuration for SSL
RUN echo "mysqli.default_socket = /var/run/mysqld/mysqld.sock\n\
mysqli.default_host = localhost\n\
mysqli.allow_local_infile = On" > /usr/local/etc/php/conf.d/mysqli-ssl.ini

# Enable Apache mod_rewrite
RUN a2enmod rewrite

# Copy custom Apache configuration with AllowOverride enabled
COPY apache-wordpress.conf /etc/apache2/sites-available/000-default.conf

# Custom entrypoint to handle TiDB Cloud SSL
COPY docker-entrypoint-ssl.sh /usr/local/bin/
RUN chmod +x /usr/local/bin/docker-entrypoint-ssl.sh

ENTRYPOINT ["docker-entrypoint-ssl.sh"]
CMD ["apache2-foreground"]