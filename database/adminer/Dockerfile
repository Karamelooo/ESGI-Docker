FROM alpine:latest

# Installation de PHP, Apache, et curl
RUN apk --no-cache update \
    && apk --no-cache add curl php-apache2 php-session php-pdo php-pdo_mysql php-pdo_pgsql \
    && curl -L https://www.adminer.org/latest.php -o /var/www/localhost/htdocs/index.php \
    && echo "ServerName localhost" >> /etc/apache2/httpd.conf \
    && sed -i 's/DirectoryIndex index.html/DirectoryIndex index.php index.html/' /etc/apache2/httpd.conf

# Exposer le port 80 (par défaut pour Apache)
EXPOSE 80

# Commande par défaut pour démarrer Apache
CMD ["httpd", "-D", "FOREGROUND"]
