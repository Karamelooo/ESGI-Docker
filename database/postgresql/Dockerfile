FROM alpine:latest

# Installation de l'outil de gestion de base de données
RUN apk --no-cache add adminer

# Compare this snippet from database/postgresql/Dockerfile:
# # Installation de PostgreSQL
# RUN apk --no-cache add postgresql
# 
# # Créer un utilisateur et une base de données
# RUN su - postgres -c "initdb -D /var/lib/postgresql/data"
# RUN su - postgres -c "pg_ctl -D /var/lib/postgresql/data start"
# RUN su - postgres -c "createdb my_database"
#
# # Lancer le serveur PostgreSQL
# CMD su - postgres -c "postgres -D /var/lib/postgresql/data"