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

Instalar php mailer

    composer require phpmailer/phpmailer

Actualizar archivo

    composer update


Base de Datos

    CREATE DATABASE `appsalon_mvc`

    CREATE TABLE `usuarios` (
    `id` int NOT NULL AUTO_INCREMENT,
    `nombre` varchar(60) DEFAULT NULL,
    `apellido` varchar(60) DEFAULT NULL,
    `email` varchar(30) DEFAULT NULL,
    `telefono` varchar(10) DEFAULT NULL,
    `admin` tinyint(1) DEFAULT NULL,
    `confirmado` tinyint(1) DEFAULT NULL,
    `token` varchar(15) DEFAULT NULL,
    PRIMARY KEY (`id`)
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

    CREATE TABLE `usuarios` (
    `id` int NOT NULL AUTO_INCREMENT,
    `nombre` varchar(60) DEFAULT NULL,
    `apellido` varchar(60) DEFAULT NULL,
    `email` varchar(30) DEFAULT NULL,
    `telefono` varchar(10) DEFAULT NULL,
    `admin` tinyint(1) DEFAULT NULL,
    `confirmado` tinyint(1) DEFAULT NULL,
    `token` varchar(15) DEFAULT NULL,
    `password` varchar(60) DEFAULT NULL,
    PRIMARY KEY (`id`)
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

    
    CREATE TABLE `citas` (
    `id` int NOT NULL AUTO_INCREMENT,
    `fecha` date DEFAULT NULL,
    `hora` time DEFAULT NULL,
    `usuarioId` int DEFAULT NULL,
    PRIMARY KEY (`id`),
    KEY `citas_usuarios_FK` (`usuarioId`),
    CONSTRAINT `citas_usuarios_FK` FOREIGN KEY (`usuarioId`) REFERENCES `usuarios` (`id`) ON DELETE SET NULL ON UPDATE SET NULL
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

    CREATE TABLE `citasservicios` (
    `id` int NOT NULL AUTO_INCREMENT,
    `citaId` int DEFAULT NULL,
    `servicioId` int DEFAULT NULL,
    PRIMARY KEY (`id`),
    KEY `citasservicios_citas_FK` (`citaId`),
    KEY `citasservicios_servicios_FK` (`servicioId`),
    CONSTRAINT `citasservicios_citas_FK` FOREIGN KEY (`citaId`) REFERENCES `citas` (`id`) ON DELETE SET NULL ON UPDATE SET NULL,
    CONSTRAINT `citasservicios_servicios_FK` FOREIGN KEY (`servicioId`) REFERENCES `servicios` (`id`) ON DELETE SET NULL ON UPDATE SET NULL
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

    INSERT INTO servicios (nombre,precio) VALUES
	 ('Corte de Cabello Mujer',90.00),
	 ('Corte de Cabello Hombre',80.00),
	 ('Corte de Cabello Niño',60.00),
	 ('Peinado Mujer',80.00),
	 ('Peinado Hombre',60.00),
	 ('Peinado Niño',60.00),
	 ('Corte de Barba',60.00),
	 ('Tinte Mujer',300.00),
	 ('Uñas',400.00),
	 ('Lavado de Cabello',50.00),
	 ('Tratamiento Capilar',150.00);
