# Créer le réseau

`docker network create my-network`

`docker compose -f database/compose.yml -f web/compose.yml up`

# Lancer Postgres

Dans le répertoire database
`docker compose up --build`

# Modifier le mot de passe

`docker exec database-postgres-1 psql -h /tmp`

`ALTER USER postgres WITH PASSWORD 'postgres';`
