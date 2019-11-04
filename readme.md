# Api + Node + Express + Mysql

Api sencilla hecha con Laravel y Mysql lista para que sirva de base para hacer tus endpoint para tu proyecto de backend y/o para consumir desde tu aplicación movil 

## Comenzando

Hasta ahora no tenemos ningun tipo de seguridad pues se ha hecho pensando solo en listar informacón que pueda ser consultada de los dispositivos anteriormente mensionado

### Requisitos Previos

Tener instalado tu servidor APACHE + PHP + Mysql

Este proyecto fué desarrollado bajo las siguientes versiones

Apache 2.4.35

Mysql 5.7.24

PHP 7.2.19

### Instalación

Lo primero que tienes que hacer es navegar hasta la carpeta raiz del proyecto e instalar todas las dependencias

Eso lo hacemos ejecutando el sisguiente comando

```
composer install
```

Luego que termine el proceso de instalación de todos los módulos necesarios ya puedes echar a andar el proyecto.

Esto se hace ejecutando el comando:

```
php artisan serve
```

Ya con esto es todo y tienes ejecuntando el proyecto en tu servidor http://localhost:8000

las Api's disponibles en esta versión son:

GET /api/users
Para listar todos los usuarios

GET /api/users/search
Para buscar entre los usuarios

GET /api/users/:id
Para mostrar los datos de un usuario

POST /api/users
Para listar los usuarios

PUT /api/users/:id
Para editar los datos de un usuario

DELETE /api/users/:id
Para eliminar un usuario

### Finalmente

Recuerda tener instalado tu servidor web instalado y tambíén tener PHP mayor o igual a la versión 7.1 que es lo mínimo que necesita laravel