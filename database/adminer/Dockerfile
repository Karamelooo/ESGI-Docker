FROM alpine:latest

# Installation de PHP et d'Adminer
RUN apk --no-cache update \
&& apk upgrade \
    && apk --no-cache add wget php php-session php-pdo php-pdo_mysql php-pdo_pgsql \
    && mkdir -p /var/www/html && \
    wget -O /var/www/html/adminer.php https://www.adminer.org/latest.php

# Exposer le port par défaut utilisé par Adminer
EXPOSE 8080

# Commande par défaut pour démarrer Adminer
CMD ["php", "-S", "0.0.0.0:8080", "-t", "/var/www/html"]