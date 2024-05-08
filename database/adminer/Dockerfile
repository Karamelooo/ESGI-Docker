FROM alpine:latest

# Installation de PHP et d'Adminer
RUN apk --no-cache update \
    && apk --no-cache add curl php php-session php-pdo php-pdo_mysql php-pdo_pgsql nginx \
    && mkdir -p /var/www/html \
    && curl -o /var/www/html/adminer.php https://www.adminer.org/latest.php

# Configuration de Nginx pour servir Adminer
COPY nginx.conf /etc/nginx/nginx.conf

# Commande par défaut pour démarrer Adminer
# Installation de l'outil de gestion de base de données
CMD nginx -g "daemon off;" \
    && php -S localhost:8080 -t /var/www/html \
    && apk --no-cache add adminer \
    tail -f /dev/null