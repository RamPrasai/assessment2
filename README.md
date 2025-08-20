# Assignment 2 - COSC360 / COSC560

This project is a Laravel web application built for Assignment 2.  
It includes authentication, admin dashboard, and CRUD features for posts and categories.

---

## Requirements
- PHP 8+
- Composer
- Laravel (latest)
- MySQL (running through XAMPP or similar)
- Node.js (optional, for frontend assets if needed)

---

## Setup
1. Clone this repo and move into the folder:
   git clone <repo-link>
   cd <project-folder>

2. Install dependencies:
   composer install

3. Copy .env file:
   cp .env.example .env

4. Generate app key:
   php artisan key:generate

5. Update database settings in .env (use XAMPP defaults if unsure):
   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=2025_a2_cosc560_ramprasai_220291642
   DB_USERNAME=root
   DB_PASSWORD=

6. Run migrations and seed:
   php artisan migrate:fresh --seed

---

## Accounts
Seeder creates two accounts:

- Admin:  
  Email: admin@example.com  
  Password: password  

- User:  
  Email: user@example.com  
  Password: password  

---

## Running the App
Start server with:
php artisan serve --host=127.0.0.1 --port=8001

Visit:
http://127.0.0.1:8001

---

## Features
- User authentication (login/register/logout)
- Admin-only routes under /admin
- CRUD for posts and categories
- Form validation
- Flash messages for feedback
- Error pages (403/404)
- Bootstrap 5 styling
