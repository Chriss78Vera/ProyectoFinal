# LARAVEL - PROYECT
Dentro de este repositorio encontramos una página funcional sobre un sistema carcelario

En cada rama se encuentra los push subidos por los diferentes compañeros que se encuentran en el grupo.

# Installation
* Clonar el repo
* Instalar Composer y NPM

        composer install && npm install
        
* Copiar .env.example a .env
* Generar app key

        php artisan key:generate
        
* Correr las migraciones de la base de datos

        php artisan migrate:fresh
        
* Compiliar los Assets
        
        npm run dev
        
* Iniciar el server
        
        php artisan serve

