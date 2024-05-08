# Utiliser une image Alpine de base
FROM alpine:latest

# Mise à jour de l'index des paquets
RUN apk update && apk upgrade

# Installer PostgreSQL
RUN apk update && apk add postgresql postgresql-contrib

# Créer un répertoire pour stocker les données de PostgreSQL
RUN mkdir /pgdata

# Définir les permissions appropriées sur le répertoire /pgdata
RUN chown -R postgres:postgres /pgdata
RUN chmod 700 /pgdata

# Exposer le port par défaut de PostgreSQL
EXPOSE 5432

# Démarrez PostgreSQL au démarrage du conteneur
CMD ["postgres", "-D", "/pgdata"]

# Initialiser la base de données PostgreSQL
RUN su postgres -c "/usr/bin/initdb -D /pgdata"

# Modifier la configuration pour utiliser un répertoire de verrouillage différent
RUN echo "unix_socket_directories = '/tmp'" >> /pgdata/postgresql.conf

# Démarrer le service PostgreSQL
RUN su postgres -c "/usr/bin/pg_ctl -D /pgdata -o '-c listen_addresses=' -w start"