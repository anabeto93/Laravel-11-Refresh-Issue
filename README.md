# Laravel Eloquent Refresh() Problem Demo

This is simply to demonstrate the problem with calling eloquent `refresh()` on a model with specified columns and related models.

## Getting Started

Follow these steps to set up and run the example application:

### Prerequisites

Ensure you have Composer and PHP installed on your system. This project was built using Laravel, which requires PHP >= 7.3 and a compatible Composer version.

### Installation

1. Clone the repository to your local machine:

    ```bash
    git clone https://github.com/anabeto93/Laravel-11-Refresh-Issue
    ```

2. Navigate to the project directory:

    ```bash
    cd path-to-your-project
    ```

3. Install dependencies:

    ```bash
    composer install
    ```

4. Create an `.env` file from the example file. You may need to adjust database connection settings in `.env`:

    ```bash
    cp .env.example .env
    ```

5. Generate an application key:

    ```bash
    php artisan key:generate
    ```

6. Run migrations and seed the database:

    ```bash
    php artisan migrate:refresh --seed
    ```

### Running the Application

Serve the application using the following Artisan command:

```bash
php artisan serve --port=2011
```

### Problem Identification

Visit [http://localhost:2011/api/refresh](http://localhost:2011/api/refresh)

The code for this can be found in the `routes/api.php` file.

#### Sample Responses Screenshots
1. Fetching User with Related Order and Products
2. When It Is Refreshed