<p align="center">
    <a href="https://imammuda.rf.gd">
    <img src="https://i.ibb.co.com/9N4z2kc/logoimammuda.png" alt="logoimammuda" border="0" width="400" style="margin:0 auto">
    </a>
</p>

# Imam Muda

Laravel 11 Admin Dashboard Imam muda for absent and monitoring

## Requirements

-   PHP 8.2+
-   Composer
-   Database (MySQL, PostgreSQL, etc.)

## Installation

### 1. Clone the repository

```bash
git clone https://github.com/declouv/imam-muda.git
cd imam-muda
```

### 2. Install Dependencies

-   Install PHP dependencies with Composer:

    ```bash
    composer install
    ```

### 3. Set Up Environment Variables

-   Copy the `.env.example` file to `.env`:

    ```bash
    cp .env.example .env
    ```

-   Open the `.env` file and update the following variables:

    ```bash
    APP_NAME=imammuda
    APP_URL=http://localhost
    DB_CONNECTION=mysql
    DB_HOST=127.0.0.1
    DB_PORT=3306
    DB_DATABASE=imammuda
    DB_USERNAME=root
    DB_PASSWORD=
    ```

### 4. Generate Application Key

```bash
php artisan key:generate
```

### 5. Run Migrations and seed

```bash
php artisan migrate --seed
```

### 6. Serve the Application

-   Run the built-in Laravel development server:

    ```bash
    php artisan serve
    ```

-   Visit [http://localhost:8000](http://localhost:8000) in your browser.

make with 💝 by [kenndeclouv](https://kenndeclouv.rf.gd)
