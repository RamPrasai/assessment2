# Assignment 2 - COSC360 / COSC560

GitHub Repo: https://github.com/YourUsername/assessment2

This project is a Laravel web application built for Assignment 2.  
It includes authentication, an admin dashboard, and CRUD features for posts and categories.

---

## Setup
1. Clone the repository
   git clone <repo-link>
   cd assessment2

2. Install dependencies
   composer install

3. Copy and configure the environment file
   cp .env.example .env

   Make sure to set the database using the required format
   DB_DATABASE=2025_a2_cosc560_ramprasai_220291642

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
I started by setting up the Laravel project with the provided template and installing authentication using laravel ui.  
Then I created migrations, models, and controllers for both posts and categories.  
I implemented full CRUD operations with views for listing, creating, editing, and deleting records.  
Middleware was added to separate admin-only routes from normal user routes.  
I set up validation for forms, added flash messages for feedback, and styled everything with Bootstrap.  
Seeders were used to generate admin and user accounts and some initial data.  
Finally, I added error pages and tested the flows to confirm the application matched the requirements.

### Challenges
The first challenge was making sure the database followed the correct naming format required in the specification.  
I also faced issues with route model binding and access restrictions which I solved by carefully applying middleware.  
Validation rules and error messages required some debugging to display correctly in the views.  
Another challenge was resetting the database during testing, which I fixed using migrate fresh with seed.  
Overall, these issues were manageable and helped me understand Laravel more deeply.
