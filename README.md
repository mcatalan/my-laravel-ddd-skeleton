# my-laravel-ddd-skeleton
My Laravel Framework skeleton for DDD.

Install and initialization steps:

1. Clone the project in a ~/projects/{project_folder} folder. If you don't want to use this path, change the mapping on docker-compose.yml line 11
2. Go to ~/projects/{project_folder}
3. Execute: cp .env.example .env


    if ('Do you want to use the project docker') { // Recommended
    
        3.1. Go to {project_folder}/.docker/webserver-php8 and execute "docker-compose up -d" for create and initialize the project docker container
        3.2. Execute "docker exec -ti webserver_php8_container bash" to get into the container
        3.3. In the container, go to /var/www/{project_folder}
    
    }

4. Execute: composer install
5. Execute: chmod -R 777 storage/framework
6. Execute: php artisan key:generate --ansi
7. Go to the web browser and type "my-laravel-ddd-skeleton.com"

