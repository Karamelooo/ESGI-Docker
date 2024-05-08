FROM alpine:latest

# Mise à jour de l'index des paquets
RUN apk update && apk upgrade

# Installer PostgreSQL
RUN apk add postgresql postgresql-contrib

# Créer un répertoire pour stocker les données de PostgreSQL
RUN mkdir /var/lib/postgresql/data

# Définir les permissions appropriées sur le répertoire /pgdata en utilisant le .env file pour les variables d'environnement
RUN chown -R postgres:postgres /var/lib/postgresql/data \
  && chmod 700 /var/lib/postgresql/data

# Démarrez PostgreSQL au démarrage du conteneur
CMD postgres -D /var/lib/postgresql/data

# Initialiser la base de données PostgreSQL
RUN su postgres -c "/usr/bin/initdb -D /var/lib/postgresql/data"

# Modifier la configuration pour utiliser un répertoire de verrouillage différent
RUN echo "unix_socket_directories = '/tmp'" >> /var/lib/postgresql/data/postgresql.conf

# Démarrer le service PostgreSQL
RUN su postgres -c "/usr/bin/pg_ctl -D /var/lib/postgresql/data -o '-c listen_addresses=' -w start"