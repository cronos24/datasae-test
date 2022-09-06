<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400"></a></p>

<p align="center">
<a href="https://travis-ci.org/laravel/framework"><img src="https://travis-ci.org/laravel/framework.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>



## Requisitos
- 1- <a href="https://getcomposer.org/download/" target="_blank">Composer</a> 
- 2- <a href="https://nodejs.org/es/download/" target="_blank">Node Js V14</a> 
- 3- <a href="https://www.php.net/downloads" target="_blank">Php >= 7.3</a> 
- 4- <a href="https://dashboard.pusher.com/" target="_blank">Pusher Account</a> 

## Instalación

Siga en orden los siguientes pasos de instalación:

- 1- git clone https://github.com/cronos24/datasae-test.git
- 2- cd datasae-test
- 3- composer install
- 4- npm install- 
- 5- Renombrar archivo .env.exmaple a .env
- 6- Configurar archivo .env con nuestras credenciales de base de datos y de pusher.
- 7- php artisan key:generate
- 8- php artisan migrate
- 9- Configurar nuestro cron en caso de querer probar la tarea automatizada <a href="https://laravel.com/docs/9.x/scheduling" target="_blank">documentación</a> 
- 10- En caso de querer probar manualmente ejecutar el comando "php artisan spin:roulette"
- 11- Ejecute los comandos para correr el servidor localmente "php artisan serve" y "npm run watch"
- 12- En caso de querer subirlo a un hosting seguir recomendaciones de la documentación <a href="https://laravel.com/docs/9.x/deployment" target="_blank">Despliegue</a>  


en caso de tener alguna duda puede escribirme al siguiente correo: erickm124@gmail.com