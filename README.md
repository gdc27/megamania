# Linux/MacOs
## Lancement de l'application :
```./start.sh```

## Arrêt de l'application :
```./stop.sh```

# Windows
## Lancement de l'application :
### 1. Installation des dépendences
```docker run --rm -u "$(id -u):$(id -g)" -v $(pwd)/site:/var/www/html -w /var/www/html laravelsail/php81-composer:latest composer install --ignore-platform-reqs```

### 2. Lancement des containers
```docker compose up```

## Arrêt de l'application :
```docker compose down```