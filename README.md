# my-laravel-ddd-skeleton
My Laravel Framework skeleton for DDD.

Install and initialization steps:

1. Clone the project in a ~/projects/{project_folder} folder. If you don't want to use this path, change the docker-compose.yml line 11 "~/projects:/var/www"
2. Go to ~/projects/{project_folder}
3. Execute: php -r "file_exists('.env') || copy('.env.example', '.env');"
4. Execute: php artisan key:generate --ansi


    if ('Do you want to use the project docker') { // Recommended
    
        4.1. Go to {project_folder}/.docker/webserver-php8 and execute "docker-compose up -d" for create and initialize the project docker container
        4.2. Execute "docker exec -ti webserver_php8_container bash" to get into the container
        4.3. In the container, go to /var/www/{project_folder}
    
    }

5. Execute: php composer.phar install
6. Execute: chmod -R 777 storage/framework
7. Go to the web browser and type "my-laravel-ddd-skeleton.com"

