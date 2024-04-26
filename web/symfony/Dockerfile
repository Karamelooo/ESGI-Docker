# Utilisez Alpine Linux comme image de base
FROM alpine:latest

# Copiez les fichiers de l'image my_composer
COPY --from=my_composer / /

# Répertoire de travail
WORKDIR /

RUN apk add --no-cache bash curl git
RUN curl -1sLf 'https://dl.cloudsmith.io/public/symfony/stable/setup.alpine.sh' | bash
RUN apk add symfony-cli

# Installez Symfony avec Composer

RUN composer create-project symfony/skeleton symfony
RUN composer require symfony/console
RUN composer require --dev symfony/maker-bundle


# Exposez le port 8000 (ou tout autre port que vous utilisez pour Symfony)
EXPOSE 8000

# Commande par défaut pour exécuter Symfony

# CMD symfony check:requirements
# CMD symfony new my_project
CMD php symfony server:start --no-tls
# CMD php bin/console server:run 0.0.0.0:8000