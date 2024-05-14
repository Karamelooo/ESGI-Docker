FROM alpine:latest

# Définir un port d'écoute par défaut pour PostgreSQL
EXPOSE 5432

# Mise à jour de l'index des paquets
RUN apk update && apk upgrade

# Installer PostgreSQL
RUN apk add --no-cache ncurses libedit db cyrus-sasl openldap postgresql-libs postgresql-client tzdata libxml2 postgresql

# Créer un répertoire pour stocker les données de PostgreSQL
RUN mkdir /run/postgresql \
  && chown postgres:postgres /run/postgresql

# Changer d'utilisateur postgres et assigner un répertoire de travail
USER postgres
ENV POSTGRES_PASSWORD postgres
ENV POSTGRES_DB postgres
WORKDIR /var/lib/postgresql

# Créer un répertoire pour stocker les données de PostgreSQL
RUN mkdir /var/lib/postgresql/data \
&& chmod 700 /var/lib/postgresql/data

# Initialiser la base de données PostgreSQL
RUN initdb -D /var/lib/postgresql/data

# Démarrer le service PostgreSQL
CMD ["postgres", "-D", "/var/lib/postgresql/data"]