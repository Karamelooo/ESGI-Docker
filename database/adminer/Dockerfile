FROM alpine:latest

# Installation de PHP et d'Adminer
RUN apk --no-cache update \
    && apk --no-cache add curl php php-session php-pdo php-pdo_mysql php-pdo_pgsql \
    && mkdir -p /var/www/html \
    && curl -o /var/www/html/adminer.php https://www.adminer.org/latest.php

# Commande par défaut pour démarrer Adminer
RUN php -S localhost:8080 -t /var/www/html
# ou ENTRYPOINT php -S localhost:8080 -t /var/www/html