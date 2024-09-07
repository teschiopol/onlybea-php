# OnlyBEA ✨

Best Employees Advisor

## Requirements 🤖

App is tested with

- PHP v8.3.7
- Laravel v11.21.0
- Vue v3.4

## Install 💾

```bash
composer install

php artisan migrate

npm i

npm run build
```

Change file .env.example in .env and launch

```bash
php artisan key:generate
```

Copy the key in APP_KEY

## Run 🏃🏻‍♂️

```bash
php artisan serve
```

Then open the [web app](http://localhost:8000/).

Enter admin@test.it - admintest

If you want example data

```bash
php artisan db:seed
```

## Docker 🐳

```bash
docker compose up
```

## Test 🔍

```bash
php artisan test
```

### Troubleshoot 🛠️

If you encounter in a error like `No application encryption key has been specified.`, try this command and then restart the server.

```bash
php artisan key:generate
```

Problem with database, simple use:

```bash
php artisan migrate:fresh --seed
```
