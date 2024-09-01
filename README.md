# API CRUD Generator

`API CRUD Generator` is a Laravel package designed to automate the creation of API CRUD (Create, Read, Update, Delete) operations for specified models. This package generates all necessary components, such as models, controllers, request validation, API resources, migration files, and updates the API routes automatically.

## Features

- **Model Generation:** Automatically creates a model with fillable attributes.
- **Controller Generation:** Creates an API resource controller with all CRUD methods (index, show, store, update, delete).
- **Request Validation Generation:** Generates a request class with validation rules based on provided fields.
- **Migration Generation:** Creates a migration file for database table creation.
- **API Resource Generation:** Generates a resource class for transforming model instances in API responses.
- **Route Registration:** Automatically appends API routes to the `routes/api.php` file.

## Requirements

- Laravel 11
- PHP 8.2 or higher

## Installation

### Step 1: Install the Package

Use Composer to install the package:

```bash
composer require mkhaled-mu/api-crud-generator

php artisan make:crud name
e.g
php artisan make:crud Comment 
