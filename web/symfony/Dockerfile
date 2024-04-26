# Utilisez Alpine Linux comme image de base
FROM alpine:latest

# Copiez les fichiers de l'image my_composer
COPY --from=my_composer / /

# Répertoire de travail
WORKDIR /app

# Installez Symfony avec Composer
RUN composer create-project symfony/skeleton .

# Exposez le port 8000 (ou tout autre port que vous utilisez pour Symfony)
EXPOSE 8000

# Commande par défaut pour exécuter Symfony
CMD ["php", "bin/console", "server:run", "0.0.0.0:8000"]