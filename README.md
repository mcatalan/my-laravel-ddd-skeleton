# my-laravel-ddd-skeleton
My Laravel Framework skeleton for DDD.

Install and initialization steps:

1. Clone the project in a ~/projects/{project_folder} folder. If you don't want to use this path, change the docker-compose.yml line 11 "~/projects:/var/www".


    if ('Do you want to use the project docker') { // Recommended
    
        1.1. In the {project_folder}/.docker/webserver-php8 execute "docker-compose up -d" for create and initialize the project docker container.
        1.2. Execute "docker exec -ti webserver_php8_container bash" to get into the container.
        1.3. In the container, go to /var/www/{project_folder}.
    
    } else {
    
        1.1. Go to ~/projects/{project_folder}.
    
    }

2. Execute: php composer.phar install
3. Execute: chmod -R 777 storage/framework
4. Execute: php -r "file_exists('.env') || copy('.env.example', '.env');"
5. Execute: php artisan key:generate --ansi
6. Go to the web browser and type "my-laravel-ddd-skeleton.com"

