# Ping CRM



## Installation
Install PHP dependencies

-composer install

Install NPM dependencies

-npm install

Build Assets

-npm run dev

Setup Configuration

-cp .env.example .env

Generate Key

-php artisan key:generate

Database connect

Run database migrations:

```sh
php artisan migrate
```

Run database seeder:

```sh
php artisan db:seed
```

Run the dev server (the output will give the address):

```sh
php artisan serve
```

You're ready to go! Visit Ping CRM in your browser, and login with:

- **Username:** mintheimkyaw@example.com
- **Password:** secret

## Running tests


```
phpunit
```
