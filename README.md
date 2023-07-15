# Uptime Monitor

Frontend for Spatie's Laravel Uptime Monitor.

![Screenshot](https://github.com/MadeByGreyhound/uptime-monitor/assets/739599/d653733e-c971-4329-b074-ba78c5d78d5d)

## Deployment

To deploy this site to a server, first clone this repo to a directory on the server. Then, rename the `.env.example` file to `.env` and fill out the necessary variables.

Once that is done, issue the following commands in the project directory:

```
composer install --optimize-autoloader --no-dev
npm install
npm run prod
php artisan migrate
php artisan config:cache
php artisan route:cache
php artisan view:cache
```

Add the following line to cron file:

```
* * * * * cd /path-to-your-project && php artisan schedule:run >> /dev/null 2>&1
```
