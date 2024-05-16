# Api Gateway service
API Gateway — это сервис, который выступает в качестве единой точки входа для всех клиентских запросов к различным микросервисам в системе. Вот основные функции и преимущества API Gateway:

API Gateway принимает запросы от клиентов и направляет их к соответствующим микросервисам.


## Как запустить
1. Скопируйте `.env.example` в `.env`
```shell
cp .env.example .env
```
2. В файле .env заполните хосты: 
```php
USERS_AUTH_SERVICE_HOST=http://localhost:8001
ACCOUNTS_SERVICE_HOST=http://localhost:8002
TWEETS_SERVICE_HOST=http://localhost:8003
```
3. Установите зависимости
```shell
composer install
```
```shell
npm install
```
```shell
npm run build
```
5. Сгенерируйте ключ приложения
```shell
php artisan key:generate
```
6. Запустите локальный сервер
```shell
php artisan serve
```

### API Documentation
Чтобы посмотреть документацию по API, перейдите по ссылке:

http://localhost:{port}/api-docs/swagger
