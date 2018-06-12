IPM TOOL of Itsavirus [![Latest Develop Build](https://gitlab.com/itsaprojectmanager/IPM/badges/develop/pipeline.svg)](https://gitlab.com/itsaprojectmanager/IPM/commits/develop)
=====================
About
-----
This is a tool for Itsavirus to manage features and requirements based on projects releases.

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

GOOGLE Oauth2
------------

To use IPM on the local machine or on any other server you need to have a itsavirus.com email account. 
This is required to register at IPM and work with the tool.

Vhost Rules
-----

IPM must be run at the one of the following VHOSTS or the Google Oauth will not work with your instance.

- http://localhost/IPM/public/
- http://ipm.example.com