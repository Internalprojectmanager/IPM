Internal Project Manager (IPM) [![Latest Master Build](https://gitlab.com/itsaprojectmanager/IPM/badges/master/pipeline.svg)](https://gitlab.com/itsaprojectmanager/IPM/commits/master)
=====================
About
-----
This is a tool to manage features and requirements based on projects releases.

Installation
------------
- git clone ssh://git@gitlab.com/itsaprojectmanager/IPM.git
- cd IPM
- cp .env.example .env
- composer install
- Change example database settings to own database settings in .env file
- php artisan key:generate (If key is not already generated)
- php artisan migrate (migrates database)
- php artisan db:seed (seed the database with dummy data)

Vhost Rules
-----

IPM must be run at the one of the following VHOSTS or the Google Oauth will not work with your instance.

- http://localhost/IPM/public/
- http://ipm.example.com