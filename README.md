# Linux/MacOs
## Lancement de l'application :
```./start.sh```
    
### Une fois les containers lancés, faire:
    > cd site
    > ./vendor/bin/sail npm run dev

Le site est alors dispo au port 80. 
Pour se connecter, utilisez l'utilisateur "user" (sinon créez un utilisateur sur localhost:80/register) :
```email : u.u@user.com```
```mdp : password```


## Arrêt de l'application :
```./stop.sh```

# Windows
## Lancement de l'application :
### 1. Installation des dépendences
```docker run --rm -u "$(id -u):$(id -g)" -v $(pwd)/site:/var/www/html -w /var/www/html laravelsail/php81-composer:latest composer install --ignore-platform-reqs```

### 2. Lancement des containers
```docker compose up```

### Une fois les containers lancés, faire:
    > cd site
    > ./vendor/bin/sail npm run dev

Le site est alors dispo au port 80.
Pour se connecter, utilisez l'utilisateur "user" (sinon créez un utilisateur sur localhost:80/register)  :
```email : u.u@user.com```
```mdp : password```

## Arrêt de l'application :
```docker compose down```