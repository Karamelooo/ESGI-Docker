# Image Composer
FROM alpine:latest AS custom_composer
WORKDIR /app
# Mise à jour de l'index des paquets
RUN apk update && apk upgrade

# Installation du dernier PHP et de ses extensions
RUN apk --no-cache add php \
    php-cli \
    php-json \
    php-phar \
    php-openssl \
    php-curl \
    php-mbstring

# Installation de Composer
RUN php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');" \
    && php composer-setup.php --install-dir=/usr/local/bin --filename=composer \
    && php -r "unlink('composer-setup.php');"

# Image Symfony
FROM alpine:latest AS custom_symfony

# Copiez les fichiers de l'image custom_composer
COPY --from=custom_composer /app ./

# Installation des dépendances
RUN apk --no-cache add curl bash

# Télécharger et exécuter l'installateur Symfony
RUN curl -sS https://get.symfony.com/cli/installer | bash

CMD composer create-project symfony/skeleton my_project \
  && composer require symfony/console \
  && composer require --dev symfony/maker-bundle

# Permettre à l'utilisateur de lancer des commandes Symfony
RUN chmod +x bin/console; sync;

# Lancer le serveur web
CMD php bin/console server:start

# Exemple de commandes supplémentaires pour configurer Symfony
# RUN php bin/console cache:clear --no-debug --no-warmup
# RUN php bin/console assets:install public