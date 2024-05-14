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
    php-tokenizer

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

# Copiez les fichiers de l'image custom_composer
COPY --from=custom_composer / ./
WORKDIR /app

# Installation des dépendances
RUN apk --no-cache add curl bash busybox-extras

# Télécharger et exécuter l'installateur Symfony
RUN curl -1sLf 'https://dl.cloudsmith.io/public/symfony/stable/setup.alpine.sh' | bash
RUN apk add symfony-cli bin/console

# Permettre à l'utilisateur de lancer des commandes Symfony
RUN chmod +x bin/console; sync;

# créer un nouveau projet Symfony
RUN composer create-project symfony/skeleton my_project \
  && cd my_project \
  && composer require symfony/console \
  && composer require -W --quiet webapp \
  # symfony/orm-pack  \
#   && echo "symfony/console symfony/orm-pack" \
#   && composer require --dev symfony/maker-bundle fzaninotto/faker doctrine/doctrine-fixtures-bundle \
#   && echo "symfony/maker-bundle fzaninotto/faker doctrine/doctrine-fixtures-bundle" \
  && composer install \
  && composer update

# Créer la base de données

RUN symfony console doctrine:database:create

# Copier les fichiers de todo liste
COPY ./config_todo/ /app/config_todo/
COPY ./config_todo/src /app/my_project/src
COPY ./config_todo/templates/ /app/my_project/templates
COPY ./config_todo/ServiceEntityRepository.php /app/my_project/vendor/doctrine/doctrine-bundle/src/Repository/ServiceEntityRepository.php

RUN symfony console make:migration && symfony console doctrine:migrations:migrate

# Lancer le serveur web
CMD symfony server:start --no-tls

# Exemple de commandes supplémentaires pour configurer Symfony
# RUN php bin/console cache:clear --no-debug --no-warmup
# RUN php bin/console assets:install public