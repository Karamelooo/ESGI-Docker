# Créer le réseau

`docker network create my-network`

# Lancer Postgres

Dans le répertoire database
`docker compose up --build`

# Modifier le mot de passe

`docker exec database-postgres-1 psql -h /tmp`

`ALTER USER postgres WITH PASSWORD 'postgres';`

# Lancer Symfony

Dans le répertoire web
`docker compose up --build`
