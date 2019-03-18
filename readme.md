# API Weather observations

### Installation

This API requires [PHP](http://www.php.net/) v7.0+ to run.

Clone the project:
```sh
$ git clone https://github.com/ricardohenrique/weather-observations.git
```

Go to folder:
```sh
$ cd weather-observations
```

Install the dependencies:
```sh
$ composer install
```

Create your .env:
```sh
$ cp .env.example .env
```

Configure your .env:
```sh
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE={YOUR_NAME_DATABASE}
DB_USERNAME={YOUR_USERNAME}
DB_PASSWORD={YOUR_PASSWORD}
```

Run the migrates and seed:
```sh
$ php artisan migrate && php artisan db:seed
```
Command to test:
```sh
$ php artisan observations:generate
```

### API Resources


| Method | URI | Description |
| ------ | ------ | ------ |
| POST | [/api/observations] | Create a new observation |
| GET | [/api/statistics/temperature/max] | Get a max temperature registrated |
| PUT | [/api/statistics/temperature/min] | Get a min temperature registrated |
| DELETE | [/api/statistics/temperature/mean] | Get a avg temperature |
| POST | [/api/statistics/observations] | Get the observatories and them observations |
| GET | [/api/statistics/distance] | Get total distance |
