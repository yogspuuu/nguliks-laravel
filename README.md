# Surplus Pretest API
----------

# Getting started

## Installation

Please check the official laravel installation guide for server requirements before you start. [Official Documentation](https://laravel.com/docs/10.x/installation#main-content)

Clone the repository

    git clone https://github.com/yogspuuu/surplus-pretest-api

Switch to the repo folder

    cd surplus-pretest-api

Install all the dependencies using composer

    composer install

Copy the example env file and make the required configuration changes in the .env file

    cp .env.example .env

Generate a new application key

    php artisan key:generate

Run the database migrations (**Setup the database connection in .env before migrating**)

    php artisan migrate

Start the local development server

    php artisan serve

You can now access the server at http://localhost:8000

**TL;DR command list**

    git clone https://github.com/yogspuuu/surplus-pretest-api
    cd surplus-pretest-api
    composer install
    cp .env.example .env
    php artisan key:generate 
    
**Make sure you setup the correct database connection information before running the migrations** [Environment variables](#environment-variables)

    php artisan migrate
    php artisan serve

## Database seeding

**Populate the database with seed data with relationships which includes category, image, product_category, product_image and product. This can help you to quickly start testing the api or couple a frontend and start using it with ready content.**

Open the DummyDataSeeder and set the property values as per your requirement

    database/seeders/CategorySeeder.php
    database/seeders/ImageSeeder.php
    database/seeders/ProductSeeder.php

Run the database seeder and you're done

    php artisan db:seed

***Note*** : It's recommended to have a clean database before seeding. You can refresh your migrations at any point to clean the database by running the following command

    php artisan migrate:refresh
----------

# Code overview

## Dependencies

- Using basic larvel dependencies

## Folders

- `app/Models` - Contains all the Eloquent models
- `app/Http/Controllers/Api` - Contains all the api controllers
- `app/Http/Middleware` - Contains the JWT auth middleware
- `app/Http/Requests` - Contains all the api form requests
- `app/Http/Resources` - Contains all the data resources/transformers
- `database/migrations` - Contains all the database migrations
- `database/seeds` - Contains the database seeder
- `config` - Contains all the application configuration files
- `routes` - Contains all the api routes defined in api.php file

## Environment variables

- `.env` - Environment variables can be set in this file

***Note*** : You can quickly set the database information and other variables in this file and have the application fully working.

----------

# Testing API

Run the laravel development server

    php artisan serve

The api can now be accessed at

    http://localhost:8000/api

Request headers

|   **Required**  |   **Key**   | **Value**     |   **Note**    |
|----------	|------------------	|------------------	|------------
| Optional  | Content-Type     	| application/json 	| Headers value already injected in `app/Http/Middleware/ForceJsonResponse.php`|


API Sample can found in project root directory `sample-api-postman.json`

----------