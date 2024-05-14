# Image Composer
FROM alpine:latest AS custom_composer
WORKDIR /app
# Mise à jour de l'index des paquets
RUN apk update && apk upgrade

# Installation du dernier PHP et de ses extensions
RUN apk --no-cache add php \
    php-cli \
    php-fpm \
    php-json \
    php-phar \
    php-openssl \
    php-curl \
    php-mbstring \
    php-ctype \
    php-iconv \
    php-simplexml \
    php-xml \
    php-session \
    php-dom \
    php-tokenizer \
    php-pdo \
    php-pgsql \
    php-pdo_pgsql

# Installation de Composer
RUN php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');" \
    && php composer-setup.php --install-dir=/usr/local/bin --filename=composer \
    && php -r "unlink('composer-setup.php');"

# Copier le fichier composer.json
COPY composer.json /app/composer.json

# Installer les dépendances
RUN composer install --no-dev --optimize-autoloader \
    && composer update

# Lancer le serveur web
CMD php -S

# Image Symfony
FROM alpine:latest AS custom_symfony

# Variables d'environnement
ENV DATABASE_URL "postgresql://postgres:postgres@postgres:5432/app?serverVersion=16&charset=utf8"

# Copiez les fichiers de l'image custom_composer
COPY --from=custom_composer / ./
WORKDIR /app

# Installation des dépendances
RUN apk --no-cache add curl bash busybox-extras

# Télécharger et exécuter l'installateur Symfony
RUN curl -1sLf 'https://dl.cloudsmith.io/public/symfony/stable/setup.alpine.sh' | bash
RUN apk add symfony-cli

# Permettre à l'utilisateur de lancer des commandes Symfony
RUN chmod +x bin/console; sync;

# créer un nouveau projet Symfony
ENTRYPOINT composer create-project symfony/skeleton my_project \
  && cd my_project \
  && composer require symfony/console \
  && composer require -W --quiet webapp \
  && composer require doctrine/doctrine-fixtures-bundle --dev \
  && composer install \
  && composer update \
  && cp -r ../config_todo/src . \
  && cp -r ../config_todo/templates/ . \
  && cp ../config_todo/ServiceEntityRepository.php vendor/doctrine/doctrine-bundle/src/Repository/ \
  && php bin/console doctrine:database:create \
  && php bin/console make:migration \
  && php bin/console doctrine:migrations:migrate -n \
  && php bin/console doctrine:fixtures:load -n \
  && symfony server:start --no-tls


# Exemple de commandes supplémentaires pour configurer Symfony
# RUN php bin/console cache:clear --no-debug --no-warmup
# RUN php bin/console assets:install public