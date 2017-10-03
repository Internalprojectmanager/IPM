IPM TOOL of Itsavirus
=====================
About
-----
This is a tool for Itsavirus to manage their projects features and requirements based on releases.



Installation
------------
- git clone ssh://git@gitlab.iavconcepts.com:10022/TeamIPM/IPM-Tool.git
- cd IPM-Tool
- composer install
- cp .env.example .env
- Change example database settings to own database settings in .env file
- php artisan key:generate
- php artisan migrate (migrates database)

