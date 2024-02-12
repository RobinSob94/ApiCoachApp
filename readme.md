# Install project : 

```shell
make install
```

### Show all commands

```shell
make # or
make help
```

### Useful commands : 

```shell
> make stop # Stop all docker images
> make start # Start all docker images
> make restart # Restart all docker images
> make migration # Create migration with changes
> make migrate # Apply new migration 
> make composer # Composer install in docker container

> make docker-disable # Disable docker for php container 
> make docker-enable # Enable docker for php container
...
```

If you disable docker for php container, you should create a .env.local file with 

```dotenv
MAILER_DSN=smtp://localhost:1025
DATABASE_URL="postgresql://symfony:password@localhost:5432/postgres?serverVersion=15&charset=utf8"
```

If make is not enabled or if it doesn't work :

```shell
# make install :
> docker compose build
> docker compose run php composer install -o
> docker compose run php php bin/console lexik:jwt:generate-keypair --overwrite --no-interaction
> docker compose up -d --remove-orphans
> docker compose exec php php bin/console doctrine:database:create --if-not-exists
> docker compose exec php php bin/console doctrine:migrations:migrate -n 

# make stop :
> docker compose down

# make start :
> docker compose up -d --remove-orphans

# make restart :
> docker compose down
> docker compose up -d --remove-orphans

# make sh :
> docker compose exec php sh

# make migration :
> docker compose exec php php bin/console make:migration -n

# make migrate :
> docker compose exec php php bin/console doctrine:migrations:migrate -n

# make composer :
> docker compose exec php install -o

# make data :
> docker compose exec php php bin/console hautelook:fixture:load --no-interaction

# make cache :
> docker compose exec php php bin/console cache:clear

# make bddReset :
> docker compose down database --volumes
> docker compose up -d database
> docker compose exec php php bin/console doctrine:database:create --if-not-exists
> docker compose exec php php bin/console doctrine:migrations:migrate -n
```


Dernières avancées sur le JWT token
Le site utilisé, https://api-platform.com/docs/core/jwt/

Les avancées -->    
- Dans le swagger UI j'ai le bouton authorize qui marche, je n'ai pas encore tester ce qu'il fait
- Toujours dans le swagger UI j'ai la route /auth qui apparait maintenant mais c'est la route api/token
qui devrait passer. 
- J'ai refait tout le security.yaml en fonction du tuto.
- J'ai modifié le lexik_kwt_authentication.yaml
- Après vérification le seul moyen de passer par un auth dans api platform est de passer par le JWT
- Il semble que l'on puisse sécuriser les routes directement dans le swagger UI mais je n'ai pas test
- La mise en place d'un access control dans le security.yaml provoque une erreur disant que l'on ne peut
pas override le access control. Mais il faut que l'on mette des restriction à l'accès du swaggerUI
et à l'access à ses docs.
- Problème sur la route du login check dans le swagger ui, il ne trouve pas la a route dans le controller
pourtant la route est bien accessible si l'on passe par l'URL. On se prend juste un méthodes non valide,
il faut une méthode post.