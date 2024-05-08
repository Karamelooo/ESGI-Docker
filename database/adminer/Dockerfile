FROM alpine:latest

# Installation de PHP, Nginx, et curl
RUN apk --no-cache update \
    && apk --no-cache add curl php php-session php-pdo php-pdo_mysql php-pdo_pgsql nginx \
    && mkdir -p /var/www/html \
    && curl -o /var/www/html/adminer.php https://www.adminer.org/latest.php

# Configuration de Nginx pour servir Adminer et les fichiers statiques
COPY nginx.conf /etc/nginx/nginx.conf

RUN  chmod -R 755 /var/www/html/

# Exposer le port 8080
EXPOSE 8080

# Commande par défaut pour démarrer Nginx
CMD nginx -g "daemon off;"
