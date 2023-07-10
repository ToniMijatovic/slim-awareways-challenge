#!/bin/sh

# Accept host ENV
echo "Creating nginx vhost..."
echo '172.25.0.1 host.docker.internal' >> /etc/hosts
envsubst '$$NGINX_HOST' < /etc/nginx/sites-available/default.template > /etc/nginx/sites-available/default.conf

# Switch to supervisord.
exec /usr/bin/supervisord -n -c /etc/supervisord.conf
