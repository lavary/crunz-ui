# crunz-ui

This is a web-based interface for [Crunz](https://github.com/lavary/crunz) library -  implemented with Laravel.

![Screenshot](public/assets/img/crunz-form-screenshot.png)

## Installation

To install it, clone it:

```bash
git clone git@github.com:lavary/crunz-ui.git .
```

Then, install the dependencies:

```bash
composer install
```

The next step is setting your application key:

```bash
php artisan key:generate
```

You also need to make sure you web server can write to the directories within the `storage/` and `bootstrap/cache/` directories, otherwise the application will not run.

## Configuration

The only configuration needed is your database credentials, which you'll need to put in your `.env` file.
To do this, just make a copy of `.env.example` and save it as `.env`, then put your database credentials in place.

## Migration

To create the tasks table, you'll just need to run the migration:

```bash
php artisan migrate
```

## Run the App

To run the application, you should create a virtual server in Nginx or Apache, or just use PHP's built-in server:

```bash
php -S localhost:8000 -t public
```

The parameter `-t public` option refers to the application's public directory - where `index.php` resides.

As a result, the application will be accessible via `http://localhost:8000`.

## Fetching the Events in JSON format

 Crunz-Ui also provides a sample endpoint for fetching the stored events in the database; To get the events in JSON format, just access this URL:  `http://localhost:8000/api/v1/tasks`

## Sample Task File

There is also a sample "dynamic" task file in `tasks/` directory, which shows how the fetched records are converted to events using the task builder. You can just copy this file and change the endpoint URL or create your own.


## Authentiction

Crunz-Ui doesn't implement any authentication system. Feel free to implement your desired authentication mechanism for your instance.

## If You Need Help

Please submit all issues and questions using GitHub issues and I will try to help you.


## License
Crunz-Ui is free software distributed under the terms of the MIT license.
