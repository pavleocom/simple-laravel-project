# Simple Laravel Project

A simple website utilising core functionalities of the Laravel framework.

## Features

-   Auth and Authorization with Policies
-   CRUD and Resource Controllers
-   Eloquent and Relationships
-   Model Observers
-   Blade Components
-   Database migrations and seeds
-   Form Validation and Requests
-   File management
-   Basic Bootstrap front-end
-   Pagination
-   Breadcrumbs
-   Multi Language Support
-   Email Sending Via Queues
-   Tests

## Installation & Setup

**Prerequisites:** Composer and NPM

-   Clone the repository with  **git clone**
-   Copy **.env.example**  file to  **.env**  and edit database and email credentials
-   Edit **phpunit.xml** set DB_DATABASE to your test database
-   Run **composer install**
-   Run **npm install**
-   Run **npm run development**
-   Run **php artisan key:generate**
-   Run **php artisan migrate --seed**
-   Run **php artisan storage:link**
-   Run **php artisan queue:work** -- keep it running
-   Run **php artisan serve** -- if no other web server used

**Admin Email:** admin@admin.com
**Admin Password:** password