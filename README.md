# Fitness App

Fitness app to manage workouts

# Pre-Requisites

- [xampp](https://www.apachefriends.org/download.html)
- [composer](https://getcomposer.org/)

# Installation

Application has been installed and setup using XAMPP on windows machine on port 8080.

- Clone the repository to location `C:\xampp\htdocs\`
- Go to [phpMyAdmin](http://localhost:8080/phpMyAdmin) and create database by importing `config/data/fitness.sql`
- Update database connection configuration at `config/default.php`
- Run `composer install` in the root of the project.

# Accessing the application

Application has two parts - APP, Public API

- APP should be accessible as - `http://localhost:8080/fitness/app/`
- API should be accessible as - `http://localhost:8080/fitness/api/`

Please refer postman collection at `config/data/fitness_app.postman_collection.json` for API definition.

# What's next

- API Field Validation
- Dockerize the app to setup in a single click
- Write PHP Unit test cases
- Documenting API using SwaggerHub or any other tools
- Logging and Auditing
- Errors and Exception Handling
- RESTful API best practices (versioning, authorization etc.)