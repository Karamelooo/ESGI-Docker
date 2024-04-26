# Utilisez l'image Alpine comme base
FROM alpine:latest

# Installe PHP et Composer
RUN apk --no-cache add php php-cli php-json php-phar php-openssl php-mbstring php-ctype php-tokenizer php-xml php-dom php-mysqlnd php-pdo_mysql composer

# Répertoire de travail
WORKDIR /app

# Installe les dépendances de Composer
CMD ["composer", "--version"]
