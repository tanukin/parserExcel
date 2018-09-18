Parser Excel file
=====================================
Prerequisites
---
~~~
docker CE
docker-compose
~~~
Installing
---
~~~
composer update
~~~
Settings
---
Check the file: configuration/mysql.yml
~~~
mysql:
  host: "mysql"
  port: 3306
  dbname: "app"
  user: "app"
  password: "secret"
~~~
 
Starting the environment
---
~~~
docker-compose up -d
~~~
Use
---
Created tables in the database
~~~
docker exec php-cli ./bin/console make:migration
~~~

Run parse excel file (/files/Test.xlsx)
~~~
docker exec php-cli ./bin/console make:parse Test.xlsx
~~~
