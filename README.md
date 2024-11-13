
# Project Name

## Description

UNO Test only 

## Prerequisites

- PHP >= 8.0
- Composer
- MySQL or another compatible database
- Laravel 11.x (or appropriate version)
- Mail service like mailtrap.io

## Installation

1. Clone the repository:
2. Install dependencies:
3. composer install Set up your `.env` file:
Copy the `.env.example` file and rename it to `.env`.
cp .env.example .env
4. Generate the application key:
php artisan key:generate
5. Run database migrations:
php artisan migrate

6. Seed the database with default users:

After running the migrations, seed the database to create default admin and user accounts.
php artisan db:seed

This will create:
- Admin user `admin@admin.com` with same password .
- Regular user `user@user.com` with same password.
