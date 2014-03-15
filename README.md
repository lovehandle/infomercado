infomercado
===========

Plataforma de información y participación ciudadana en los Mercados Públicos

##Instalación del ambiente de desarrollo

La aplicación esta desarrollada en PHP 5.4+ utilizando el Framework [Laravel](http://www.laravel.com)

###Requerimientos previos

Esta guía esta basada en Ubuntu 12+ pero puede ser facilmente replicado en cualquier otro sistema *nix

Actualizar a php 5.4+

```
sudo add-apt-repository ppa:ondrej/php5
sudo apt-get update
sudo apt-get upgrade
```

instalar mcrypt para php5
```
sudo apt-get install php5-mcrypt
```

composer
```
sudo curl -sS https://getcomposer.org/installer | php
```
composer en modo global
```
sudo mv composer.phar /usr/local/bin/composer
composer --version
Composer version 604a65cc31f3e5d8a2b96802135ac24434e87678 2014-03-06 09:26:16
```


###App

Clonar el repositorio
```
git clone https://github.com/LabPLC/infomercado.git
```

instalar las dependencias del proyecto a travez de composer (ejecutar desde la raiz del proyecto)
```
composer install
```

Activar la configuracion de base de datos
```
cd app/config
mv database-ejemplo.php database.php
```

Ejecutar la migracion de Laravel para crear las tablas (ejecutar desde la raiz del proyecto)
```
php artisan migrate
```

Servidor de prueba (ejecutar desde la raiz del proyecto)
```
php artisan serve --host 0.0.0.0 --port 8000
```

