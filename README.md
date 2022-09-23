# 2x3-la

## Installation

Install the dependencies and start the server.

```sh
git clone https://github.com/RonaldNolascoU/2x3-la.git
cd 2x3-la
composer install
cp .env.example .env
php artisan key:generate
php artisan migrate
php artisan db:seed
php artisan serve
```

To enable queue:

```sh
php artisan queue:work
```

Verify the deployment by navigating to your server address in
your preferred browser.

```sh
127.0.0.1:8000
```

Postman collection
https://www.getpostman.com/collections/f247ab2f955526a3a72c

## License

MIT

