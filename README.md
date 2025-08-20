# Assignment 2 - COSC360 / COSC560

GitHub Repo: https://github.com/RamPrasai/assessment2

This project is a Laravel web application built for Assignment 2.  
It includes authentication, an admin dashboard, and CRUD features for posts and categories.

---

## Setup
1. Clone the repository  
   git clone https://github.com/RamPrasai/assessment2.git  
   cd assessment2  

2. Install dependencies  
   composer install  

3. Copy and configure the environment file  
   cp .env.example .env  

   Update the database settings in .env file  
   DB_CONNECTION=mysql  
   DB_HOST=127.0.0.1  
   DB_PORT=3306  
   DB_DATABASE=2025_a2_cosc560_ramprasai_220291642  
   DB_USERNAME=root  
   DB_PASSWORD=  

4. Generate the application key  
   php artisan key:generate  

5. Run migrations and seeders  
   php artisan migrate:fresh --seed  

---

## Accounts
Admin account  
Email: admin@example.com  
Password: password  

User account  
Email: user@example.com  
Password: password  

---

## Running the Application
Start the server with  
php artisan serve --host=127.0.0.1 --port=8001  

Open the application in the browser at  
http://127.0.0.1:8001  

---

## Features
- User authentication with login, registration, and logout  
- Admin middleware with routes under /admin  
- CRUD operations for posts and categories  
- Dropdown category selection when creating posts  
- Form validation and flash messages for feedback  
- Custom error pages for 403 and 404  
- Bootstrap 5 styling for layout and forms  

---

## Report

### Approach
I began by setting up the Laravel project with the provided template and installing authentication using laravel ui.  
I created migrations, models, and controllers for posts and categories, then implemented CRUD operations with views for listing, creating, editing, and deleting records.  
Middleware was used to secure admin-only routes, and validation was applied to forms with flash messages for user feedback.  
Seeders generated initial users and sample data. Bootstrap 5 was used to style forms and layouts.  
Finally, I added error pages and tested the full flow to ensure it met the assignment requirements.  

### Challenges
The first challenge was ensuring the database name followed the required format.  
I also faced issues with middleware configuration and route model binding, which I fixed by carefully checking route definitions.  
Validation error messages and flash messages required some debugging to show correctly in views.  
Resetting the database during testing sometimes caused conflicts, but this was solved using migrate fresh with seeding.  
These challenges gave me a stronger understanding of Laravel and improved my workflow.  
