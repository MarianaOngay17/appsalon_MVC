# appsalon_MVC
Proyecto App Salon MVC - Curso Desarrollo Web

Pasos iniciales:

Instalar dependencias

    npm install

Ejecutar gulp

    npm run dev

Instalar composer

    composer init

Modificar archivo composer.json a lo siguiente

    "autoload": {
        "psr-4": {
            "MVC\\": "./", 
            "Controllers\\": "./controllers",
            "Model\\": "./models"
        }
    },

Actualizar archivo

    composer update

Compilar proyecto dentro de carpeta public

    php -S localhost:3000
