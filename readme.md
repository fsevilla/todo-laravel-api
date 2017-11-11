# Core API Project

This project is the Core API required for most of the web applications being built at the Company. This API is built using Laravel PHP Framework.

## Features

This includes the following: 

- Passport authentication

- Session Management

- Users Management


# Laravel PHP Framework

Laravel is a web application framework with expressive, elegant syntax. We believe development must be an enjoyable, creative experience to be truly fulfilling. Laravel attempts to take the pain out of development by easing common tasks used in the majority of web projects, such as authentication, routing, sessions, queueing, and caching.

Laravel is accessible, yet powerful, providing tools needed for large, robust applications. A superb inversion of control container, expressive migration system, and tightly integrated unit testing support give you the tools you need to build any application with which you are tasked.

## Official Documentation

Documentation for the framework can be found on the [Laravel website](http://laravel.com/docs).

## Contributing

Thank you for considering contributing to the Laravel framework! The contribution guide can be found in the [Laravel documentation](http://laravel.com/docs/contributions).

## Requirements

- PHP >= 5.6.4

- OpenSSL PHP Extension

- PDO PHP Extension

- Mbstring PHP Extension

- Tokenizer PHP Extension

- XML PHP Extension

- Composer


## Setup

To Get started with the project, first download the code from the repository: 
```
$ git clone git@bitbucket.org:fsevilla/pmd_api.git
```
Move to the new `laravel-api` folder and run `composer install`.

## Run

Laravel 5.3 uses the command `php artisan serve` to run & serve the application.

Additionally, you can run this project using apache2, with the following:
```
$ php -S localhost:8000 -t public/
```

Open your browser at the specified url and voilà.

Should you run with any problems, please create an issue or feel free to update this readme file with any solutions you have found.


## Migrate

We take advantage of Laravel migrations to control changes to our database. 
For this project, however, we prefer to work with plain SQL queries instead of the Schema facade provided by Laravel.

These queries are saved under the /database/migrations/sql folder, and are executed by the migration file. E.g.:
```
public function up()
    {
        DB::connection()->getPdo()->exec(file_get_contents(__DIR__.'/sql/my_sql_file.sql'));
    }
```

### Create migrations

To create a migration, use the `make:migration` commdand as follows:
```
$ php artisan make:migration create_users_table
```

The above will generate a file under database/migrations. 

### Run migrations

To run all the outstanding migrations, simply execute the following command:
```
$ php artisan migrate
```

If you want to rollback to a previous state, do the following:
```
$ php artisan migrate:rollback
```

To reset all the migrations you can do:
```
$ php artisan migrate:reset
```

## Seeding

Once our database and tables are created, we can add all the pre-defined (initial) records by executing the following command:
```
$ php artisan db:seed
```

We can run an individual seed by adding the `--class` option:
```
$ php artisan db:seed --class=UsersTableSeeder
```

If it fails to load any of your Seeder Classes try the following and then run the seed command again:

```
$ composer update
$ composer dump-autoload
```

### Generating seeds

To generate a seeder, execure the `make:seeder` command which will place the new file under the database/seeds folder.
```
$ php artisan make:seeder UsersTableSeeder
```

Same as with migrations, we prefer to run an SQL file, as it makes it easier to read and understand the query. E.g. inside of our UsersTableSeeder.php file we can do the following:
```
public function run()
{
    $sql = file_get_contents(__DIR__.'/sql/UsersTableSeeder.sql');
    \DB::connection()->getPdo()->exec($sql);
}
```

## Authentication

This project implements [Laravel Passport](https://laravel.com/docs/5.3/passport) to authenticate users, which provides a full OAuth2 server implementation for our Laravel application.

There is no need to run the `passport:install` command as the keys have already been seeded when you ran `php artisan db:seed`.


## Security Vulnerabilities

If you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell at taylor@laravel.com. All security vulnerabilities will be promptly addressed.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](http://opensource.org/licenses/MIT).