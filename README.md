# crunz-ui

This is a web-based interface for [Crunz](https://github.com/lavary/crunz) library -  implemented by Laravel framework.

![Screenshot](public/assets/imgform-screenshot.png)

## Installation

To install it, clone it:

```bash
git@github.com:lavary/crunz-ui.git
```

## Configuration

The only configuration needed is your database credentials, which you'll need to put in your `.env` file.
To do this just make a copy of `.env.example` and save it as `.env`, then put your database credentials into place.

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

## Fetching the Events in JSON format

 Crunz-Ui alsp provides a sample route for fetching the added events. To get the events in JSON format, just access this URL:  `http://localhost:8000/api/v1/tasks`


## Authentiction

Crunz-Ui doesn't implemented any authentication system. Feel free to implement your desired authentication mechanism for your instance.

## If You Need Help

Please submit all issues and questions using GitHub issues and I will try to help you.


## License
Crunz-Ui is free software distributed under the terms of the MIT license.
