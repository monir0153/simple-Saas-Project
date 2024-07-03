# server setup

### Install composer

```
composer update
```

### Copy .env.exmaple to .env

```
cp .env.example .env
```

### Generate application key

```
php artisan key:generate
```

### Database configuration

```
DB_DATABASE=saas_project
DB_USERNAME=root
DB_PASSWORD=password
```

### Migrate database with seeder

```
php artisan migrate --seed
```
