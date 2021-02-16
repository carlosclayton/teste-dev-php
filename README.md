# Laravel 8 API Cars

### 1.	Third party package

> Laravel IDE Helper Generator: https://github.com/barryvdh/laravel-ide-helper

> Laravel Dump Server: https://github.com/beyondcode/laravel-dump-server

> Laravel 5 Repositories: https://github.com/andersao/l5-repository

> Doctrine DBAL: https://github.com/doctrine/dbal

> CORS Middleware for Laravel: https://github.com/fruitcake/laravel-cors

> Dingo API: https://github.com/dingo/api

> League Fractal: https://fractal.thephpleague.com/installation/

> Laravel Dusk: https://laravel.com/docs/8.x/dusk

> L5 Swagger: https://github.com/DarkaOnLine/L5-Swagger

> Behat-Laravel-Extension: https://github.com/laracasts/Behat-Laravel-Extension

### 2.  	Configuring environment using Docker
Run the command bellow on Bash:

```
$  sudo docker-compose up -d
```  

After then, run the command bellow on Bash to access Workspace:
```
$  sudo docker exec -it cars-app bash
```  

Or, run the command bellow on Bash to access DB:
```
$  sudo docker exec -it cars-db bash
```  

### 3.  	Tests

##### 3.1  	Test using Seed
Run the command bellow on Bash:

```
$  php artisan migrate:refresh --seed
```  



##### 3.1  	Unit Test 
Run the command bellow on Bash:

```
$  vendor/bin/phpunit --filter BrandTest --testdox
$  vendor/bin/phpunit --filter CarTest --testdox
```  


##### 3.2  	Integration Test
Run the command bellow on Bash:

```
$  vendor/bin/phpunit --filter BrandModelTest --testdox
$  vendor/bin/phpunit --filter CarModelTest --testdox
```  
