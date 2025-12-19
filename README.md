# Tasklane - Project Management Simplified

Tasklane is a modern, lightweight project management application built with **Laravel 11**. 
It is designed to help students and small teams organize their projects, manage tasks, and collaborate seamlessly.

## Tech Stack
* **Backend:** PHP 8.2+ & [Laravel 12](https://laravel.com/)
* **Frontend:** [Tailwind CSS](https://tailwindcss.com/)
* **Database:** MySQL (Relational data storage)
* **Authentication:** Session-based Authentication with Laravel's built-in security features.

## Getting started
### Prerequisites
* PHP 8.2 or higher
* Composer
* MySQL Server

### Installation
1.  **Clone the repository:**
    ```bash
    git clone git@github.com:CasperHolmBach/tasklane.git
    cd tasklane
    ```
2.  **Install dependencies:**
    ```bash
    composer install
    ```
3.  **Configure Environment:**
    ```bash
    cp .env.example .env
    php artisan key:generate
    ```
    *(Update the DB credentials in your `.env` file to match your local MySQL setup)*.
4.  **Run Migrations:**
    ```bash
    php artisan migrate:fresh
    ```