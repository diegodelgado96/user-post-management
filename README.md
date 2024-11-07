# user-post-management

## Requisitos Previos

- ### Backend (PHP):

1. PHP 7.4 o superior  
1. MySQL (recomendado tener MySQL Workbench).    
1. Composer (para la gestión de dependencias de PHP).  


- ### Frontend (Angular/TypeScript):

1. Node.js (versión recomendada: 14 o superior).
1. NPM o Yarn (gestor de dependencias).
1. [Angular CLI](https://github.com/angular/angular-cli) version 17.3.0. (para crear y gestionar el proyecto Angular).


## Parte 1: Despliegue del Backend (PHP) usando la Consola

### 1. Ubicarse en la carpeta Backend:

Usando la consola asegurate de estar en la consola Backend para hacer la instalación de dependencias de php e iniciar el server.

### 2. Instalar las dependencias de PHP:

Una vez en la carpeta Backend del proyecto, ejecuta el siguiente comando para instalar todas las dependencias de PHP usando Composer:

    # composer install

### 3. Base de Datos (SQL):

En la carpeta database del proyecto, encontrarás un archivo SQL que contiene la estructura de las tablas y los datos de prueba. 

#### NOTA: Por favor, ejecuta ese sql en un gestor de mysql para tener las tablas y los valores de prueba.

Puedes usar el siguiente comando si lo deseas. Ten en cuenta que "ruta" es el complemeto de la ubicación en donde guardaste el proyecto, reemplazalo.

    mysql -u root -p blog < /ruta/user-post-management/database/userPostManagement.sql

### 4. Variables de entorno:
El la carpeta Backend debemos crear un archivo .env y agregar la variables para la conexión con la base de datos, como por ejemplo,

    DB_HOST=localhost
    DB_NAME=blog
    DB_USER=root  -> Cambiar por el usuario 
    DB_PASS=DiegoPass  -> cambiar por la contraseña


### 5. Ejecutar el Backend PHP desde la Consola de Visual Studio:
Navega al directorio Backend del proyecto y ejecuta el siguiente comando desde la terminal 

    php -S localhost:8000


## Parte 2: Despliegue del Frontend (Angular/TypeScript)

### 1. Instalar Angular CLI:

Navega hasta la carpeta Frontend y ejecuta el siguiente comando 

    npm install -g @angular/cli

### 2. Instalar Dependencias del Frontend:

En la misma carpeta Frontend ejecuta el sguiente comando para instalar las dependencias del frontent

    npm install

### 3. Configurar la API del Backend en Angular:

Asegúrate de que las rutas de la API del backend estén correctamente configuradas en el proyecto Angular. Esto normalmente se configura en el archivo environment.ts para que apunte al backend en producción o en local:

el archivo se encentra en la siguiente ruta. 

    ..../user-post-management/Frontend/environments

verifica que este apuntando a la dirección de la api 

    export const environment = {
        production: false,
        endpoint: "http://localhost:8000/api/"
    }

### 4. Arrancar el servicio:

Por último para iniciar el servicio solo debes ejecutar el siguiente comando estando en la carpeta frontend:

    npm run start


# [LINK DEL VIDEO](https://drive.google.com/file/d/1veOZxeIamubr-F8fGZ1i6zwcU1w65Trl/view?usp=sharing)