# Créer le réseau

`docker network create my-network`

# Lancer Postgres

Dans le répertoire database

Créer un fichier .env

```
POSTGRES_USER=<utilisateur>
POSTGRES_PASSWORD=<mot de passe>
POSTGRES_DB=<nom de la base>
POSTGRES_HOST=<nom de l'hôte>
```

`docker compose up --build`

# Modifier le mot de passe

`docker exec -it database-postgres-1 psql -h /tmp`

`ALTER USER postgres WITH PASSWORD 'postgres';`

# Commandes utiles

`psql -h /tmp` pour lancer psql depuis ailleurs que /run/postgresql/

`\l` pour voir les databases et leur owner

`DROP database app;` pour supprimer la database app

# Lancer Symfony

Dans le répertoire web

Créer un fichier .env

```
POSTGRES_USER=<utilisateur>
POSTGRES_PASSWORD=<mot de passe>
POSTGRES_DB=<nom de la base>
POSTGRES_HOST=<nom de l'hôte>
```

`docker compose up --build`

# Interface Adminer

http://localhost:8080/

<img width="666" alt="image" src="https://github.com/Karamelooo/ESGI-Docker/assets/42684851/846bed7e-3d1a-4cf5-a377-196cac420274">

# Interface Symfony

http://localhost:8000/

<img width="1084" alt="image" src="https://github.com/Karamelooo/ESGI-Docker/assets/42684851/6e2bf22b-33f8-4ce9-abaa-7617f0204f69">

# Accéder à la todo list

http://localhost:8000/article

<img width="203" alt="image" src="https://github.com/Karamelooo/ESGI-Docker/assets/42684851/ee75df7f-9495-4b40-8193-feb97e2123ea">
