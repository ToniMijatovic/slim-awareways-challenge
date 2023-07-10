FROM richarvey/nginx-php-fpm:2.1.2

# Remove some default files before our own config.
RUN rm /var/www/html/index.php && \
	rm /etc/nginx/sites-available/default-ssl.conf && \
	rm /start.sh

# Add our files, plus the composer installed /app.
COPY /.docker/start.sh /start.sh
COPY /.docker/default.template /etc/nginx/sites-available/default.template
COPY ./ /var/www/html/

# Install composer dependencies.
WORKDIR /var/www/html/

RUN echo "memory_limit = 4G" >> /usr/local/etc/php/conf.d/docker-vars.ini
RUN composer install --ignore-platform-reqs

# Manage permissions now.
RUN chown -Rf nginx:nginx /var/www/html && \
	chmod +x /start.sh

# Don't use their init script, do it all at build time.
CMD /start.sh
