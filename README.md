# Started Filament

A starter project using [Filament](https://filamentphp.com/) for building modern admin panels with Laravel.

## Requirements

- PHP >= 8.1
- Composer
- Laravel >= 10.x
- Node.js & npm (for assets)
- Database (MySQL, PostgreSQL, etc.)

## Getting Started

1. **Clone the repository:**
    ```bash
    git clone https://github.com/your-username/started-filament.git
    cd started-filament
    ```

2. **Install dependencies:**
    ```bash
    composer install
    npm install && npm run build
    ```

3. **Copy and configure environment:**
    ```bash
    cp .env.example .env
    # Edit .env with your database and app settings
    ```

4. **Generate application key:**
    ```bash
    php artisan key:generate
    ```

5. **Run migrations:**
    ```bash
    php artisan migrate
    ```

6. **Start the development server:**
    ```bash
    php artisan serve
    ```

## Accessing Filament

- Visit: `http://localhost:8000/admin`

## Creating a Filament User

To create an admin user for Filament, run:

```bash
php artisan make:filament-user
```

Follow the prompts to set up the user credentials.

---

For more information, visit the [Filament documentation](https://filamentphp.com/docs/).