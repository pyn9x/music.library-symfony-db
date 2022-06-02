Курсовая по бд
========

* [Установка](#Установка)

Устоновка
--------

Установка PHP 8.0:
````````
sudo apt install software-properties-common

sudo add-apt-repository ppa:ondrej/php

sudo apt update

sudo apt install php8.0 php8.0-zip php8.0-gd php8.0-mysql php8.0-xsl php8.0-curl php8.0-mbstring php8.0-intl php8.0-fpm
````````

Установка MYSQL
````````
sudo apt install mysql-server
````````

Установка Git:
````````
sudo apt install git
````````

Установка Symfony:
````````
wget https://get.symfony.com/cli/installer -O - | bash

sudo mv ~/.symfony/bin/symfony /usr/local/bin/symfony
````````

Установка Composer:
````````
wget https://getcomposer.org/download/2.0.13/composer.phar

sudo mv composer.phar /usr/bin/composer && chmod +x /usr/bin/composer
````````
Клонируем репозиторий в подходящий каталог
```
$ cd /var/www
$ git clone https://github.com/pyn9x/music.library-symfony-db.git
```

Создаем пустую базу данных и пользователя для нее
```
$ mysql -u root -p
> CREATE DATABASE music_labrary CHARACTER SET utf8 COLLATE utf8_general_ci;
> CREATE USER 'music_labrary'@'%' IDENTIFIED BY 'PASSWORD';
> GRANT ALL PRIVILEGES ON *.* TO 'music_labrary'@localhost'%' WITH GRANT OPTION;
> FLUSH PRIVILEGES;
> quit;
```
