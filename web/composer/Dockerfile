# Utilisez l'image Alpine comme base
FROM alpine:latest

# Installe PHP et Composer
RUN apk update && apk upgrade && apk --no-cache add php php-cli php-json php-phar php-openssl php-mbstring php-ctype php-tokenizer php82-xml php-dom php-mysqlnd php-pdo_mysql php-session composer

# Répertoire de travail
WORKDIR /app

# Installe les dépendances de Composer
CMD ["composer", "--version"]
