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

# Image Symfony
FROM alpine:latest AS custom_symfony
LABEL image.name="horotopia/custom_symfony" \
    image.description="Image Symfony Custom" \
    image.version="latest"
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
RUN composer create-project symfony/skeleton my_project \
  && cd my_project \
  && composer require webapp symfony/console \ 
  # symfony/orm-pack  \
  && echo "symfony/console symfony/orm-pack" \
  && composer require --dev symfony/maker-bundle fzaninotto/faker doctrine/doctrine-fixtures-bundle \
  && echo "symfony/maker-bundle fzaninotto/faker doctrine/doctrine-fixtures-bundle" \
  && composer install \
  && composer update

# Créer la base de données
RUN symfony console doctrine:database:createcd

# Copier les fichiers de todo liste
COPY ./config_todo/ /app/config_todo/

# bouger les fichiers de todo liste
RUN mv /app/config_todo/Controller/ArticleController.php /app/my_project/src/Controller/ArticleController.php \
    && mv /app/config_todo/Entity/Article.php /app/my_project/src/Entity/Article.php \
    && mv /app/config_todo/Repository/ArticleRepository.php /app/my_project/src/Repository/ArticleRepository.php \
    && mv /app/config_todo/DataFixtures/AppFixtures.php /app/my_project/src/DataFixtures/AppFixtures.php \
    && mv /app/config_todo/Form/ArticleType.php /app/my_project/src/Form/ArticleType.php \
    && mv /app/config_todo/Twig/article /app/my_project/templates/Twig/article \
    && symfony console make:migration && symfony console doctrine:migrations:migrate

# Lancer le serveur web
CMD symfony server:start --no-tls

# Exemple de commandes supplémentaires pour configurer Symfony
# RUN php bin/console cache:clear --no-debug --no-warmup
# RUN php bin/console assets:install public