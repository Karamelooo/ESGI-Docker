# Utilisez l'image Alpine comme base
FROM alpine:latest

# Installez les dépendances nécessaires pour Composer
RUN apk --no-cache add wget

# Téléchargez et installez Composer
RUN wget -q -O /usr/local/bin/composer https://getcomposer.org/composer.phar && \
    chmod +x /usr/local/bin/composer

# Définissez le répertoire de travail
WORKDIR /app

# Copiez les fichiers de l'application (composer.json, composer.lock)
COPY composer.json composer.lock ./

# Installez les dépendances avec Composer
RUN composer install --no-scripts --no-autoloader

# Copiez le reste des fichiers de l'application
COPY . .

# Exécutez d'autres commandes Composer si nécessaire

# Définissez la commande par défaut pour démarrer l'application
CMD ["php", "index.php"]
