# Uptime Monitor

Wrapper site for Spatie's Laravel Uptime Monitor.

![screenshot](https://i.imgur.com/cI46lfQ.png)

## Deployment

To deploy this site to a server, first clone this repo to a directory on the server. Then, rename the `.env.example` file to `.env` and fill out the necessary variables.

Once that is done, issue the following commands in the project directory:

```
composer install --optimize-autoloader --no-dev
npm install --only=production
php artisan migrate
php artisan config:cache
php artisan route:cache
php artisan view:cache
```

Add the following line to cron file:

```
* * * * * cd /path-to-your-project && php artisan schedule:run >> /dev/null 2>&1
```

You can then use `php artisan tinker` to add a `new User`, setting their `name`, `email`, and `password` (using the `bcrypt` function), which is necessary to access the site.
