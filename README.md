## Local Development Setup

1. Clone the repository
```bash
git clone <repository-url>
cd postcard-thing
```

2. Install PHP dependencies
```bash
composer install
```

3. Install JavaScript dependencies
```bash
npm install
```

4. Environment Setup
```bash
cp .env.example .env
php artisan key:generate
```

5. Configure SQLite database:
```bash
touch database/database.sqlite
```

6. Update your `.env` file to use SQLite:
```
DB_CONNECTION=sqlite
```

7. Run database migrations
```bash
php artisan migrate
```

8. Start the development server
```bash
# Terminal 1: Laravel development server
php artisan serve

# Terminal 2: Vite development server for frontend assets
npm run dev
```

The application should now be accessible at `http://localhost:8000`
