#Install composer dependencies
docker run --rm \
    -u "$(id -u):$(id -g)" \
    -v $(pwd)/site:/var/www/html \
    -w /var/www/html \
    laravelsail/php81-composer:latest \
    composer install --ignore-platform-reqs

#start project in docker's containers
cd site
docker compose up