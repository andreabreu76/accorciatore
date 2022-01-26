# Conteiners PHP8, Nginx & MySQL

## Steps...

```bash
cd protectname/src
``` 

```bash
docker exec -it projectname-app composer create-project laravel/laravel .
``` 

Algumas vezes é necessário setar permissões.

```bash
sudo chown -R $USER:$USER .
``` 

```bash
sudo chmod -R 777 storage/
``` 


Agora, mude o .env para seus parametros:

```bash
DB_CONNECTION=mysql
DB_HOST=database
DB_PORT=3306
DB_DATABASE=homestead
DB_USERNAME=homestead
DB_PASSWORD=secret
``` 

```bash
docker exec -it projectname-app php artisan config:clear
``` 
```bash
docker exec -it projectname-app php artisan migrate
``` 
