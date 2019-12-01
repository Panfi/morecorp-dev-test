# MoreCorp
Laravel Test application

# Installation
[PHP](https://php.net) 7+, [Laravel](https://laravel.com/docs/5.6) 5.6+ and [Composer](https://getcomposer.org) are required.
You'll need to run `composer install` or `composer update` to download all the dependencies.

# Frontend
You'll need to run `npm install`

# Configuration

Generate the encryption key `php artisan key:generate`, Run this command `cp .env.example .env` then Update DB credentials on your .env file:

```bash
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=morecorp
DB_USERNAME=root
DB_PASSWORD=******
```

Seed the database:
```bash
php artisan db:seed
```

Migrate the tables the you are good to go:
```bash
php artisan migrate
```
# ADMIN
```bash
URL: http://localhost:8000/admin/login
email: please check the DB after seeding
pass: password
````


