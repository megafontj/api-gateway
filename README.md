# Install and Set up laravel with docker compose

## Install and run
1. `git clone https://github.com/megafontj/skeleton.git ./your-folder`
2. `docker compose up`
3. `docker compose exec app composer install`
4. `docker compose exec app npm install`
5. `docker compose exec app npm run build`

## Environment file
copy `.env.example` to `.env` and fill the setting if needed

```yaml
NGINX_PORT=8080 # port for nginx
APP_PORT=9001 # port for laravel app 
VITE_PORT=5173 # vite for is for npm.
```

### API docs
To see the swagger api documentation got to this link:

`http://localhost:8080/api-docs/swagger`

don't forget the `port 8080` must be the same NGINX_PORT in `.env` file.

## Laravel
Laravel is inside the `src` folder. If you want to run artisan command use this command:

`docker compose exec app php artisan {your command}`

I also created `artisan` bash file to help run laravel artisan commands easy

`./artisan key:generate`
