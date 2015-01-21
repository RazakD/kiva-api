Narwi-API
=======================

Introduction
------------
This is a Zend Framework, Doctrine application for REST APIs for the Narwi application. The rest api's expect and return data in json format. 

Installation
------------

Using Composer (recommended)
----------------------------
The recommended way to get a working copy of this project is to clone the repository
and use `composer` to install dependencies using the command:

    composer install

Creating database using Doctrine Annotations
------------
Assuming that you have installed all the dependencies of this application by running "composer install", and having created a doctrine.local.php (structure similar to doctrine.global.php) in config/autoload directory with database configurations.

Run the following command from the root of your application. This command will read annotations present in your entities, and correspondingly create tables in the database specified in the config file (doctrine.local.php)

./vendor/bin/doctrine-module orm:schema-tool:create
