# HMS System

## Tech Stack
- Laravel 12
- Inertia.js
- React
- Tailwind CSS
- MySQL8+
- Blade
- 

## Features
- Authentication (Custom Create)
- Permissions (Custom Create)
- Dashboard with Total Customer, Total Hospital, Total Firms, Total Pharmacy, Total hospital firm wise employee and patient and doctor and nurse and staff
- Pyarmacy Management
- Hrms (All features like attendence, leaves, payroll, shift, meeting, ticket raise, task assign)
- Pagination
- Form Request Validation

## Installation
```bash
PHP 8.3.16
node 18.8.0
npm 8.18.0
git clone <repository-url>
cd hospital
cp .env.example .env
composer install
npm install
php artisan key:generate
php artisan migrate --seed
npm run dev
php artisan serve
Login Email -- test@hms.in
Password -- test
```


## Default Categories
- Salary
- Rent
- Food
- Other



## Project Structure
- app/
- resources/js/
- routes/
- database/



## Assumptions
- Each customer manage their own hospitals.



## Author
Hospital Management System




