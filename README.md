# ELITE Shop - E-Commerce Platform

<p align="center">
  <img src="https://img.shields.io/badge/Laravel-12.x-red?style=for-the-badge&logo=laravel&logoColor=white" alt="Laravel 12">
  <img src="https://img.shields.io/badge/PHP-8.2-blue?style=for-the-badge&logo=php&logoColor=white" alt="PHP 8.2">
  <img src="https://img.shields.io/badge/Vite-5.x-646CFF?style=for-the-badge&logo=vite&logoColor=white" alt="Vite">
  <img src="https://img.shields.io/badge/Bootstrap-5.x-7952B3?style=for-the-badge&logo=bootstrap&logoColor=white" alt="Bootstrap 5">
</p>

## Overview

ELITE Shop is a modern, full-featured e-commerce platform built with Laravel 12. It provides a complete shopping experience with product management, order processing, and an admin dashboard with analytics.

**Key Features:**
- 🛍️ **Customer Shop**: Browse products with advanced filtering and details
- 🛒 **Shopping Cart**: Add to cart and checkout functionality
- 📊 **Admin Dashboard**: Sales analytics and order management
- 📦 **Product Management**: CRUD operations with image upload
- 📝 **Order Tracking**: Status updates and order history
- 🔐 **Authentication**: User login, registration, and role-based access
- 🎨 **Modern UI**: Responsive Bootstrap-based design

---

## Requirements

- PHP 8.2+
- Composer 2.x
- Node.js 18+
- MySQL 8.0+ or SQLite
- NPM or Yarn

---

## Installation

### 1. Clone the Repository

```bash
git clone https://github.com/mohamedmehana/elite-shop.git
cd elite-shop
```

### 2. Install Dependencies

```bash
composer install
npm install
```

### 3. Environment Configuration

```bash
cp .env.example .env
php artisan key:generate
```

Edit `.env` and configure your database:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=elite_shop
DB_USERNAME=root
DB_PASSWORD=your_password
```

### 4. Database Setup

```bash
php artisan migrate
php artisan db:seed  # Optional: Add sample data
```

Or import the provided SQL dump:

```bash
mysql -u root -p elite_shop < ecommerce_elite.sql
```

### 5. Storage Link

```bash
php artisan storage:link
```

### 6. Build Assets

```bash
npm run build
```

### 7. Start the Application

```bash
php artisan serve
```

Visit: `http://localhost:8000`

---

## Quick Start with Composer Script

```bash
composer run setup
```

This will install dependencies, generate keys, run migrations, and build assets automatically.

---

## Project Structure

```
elite-shop/
├── app/
│   ├── Http/
│   │   ├── Controllers/
│   │   │   ├── AdminController.php      # Dashboard & analytics
│   │   │   ├── AuthController.php       # Authentication
│   │   │   ├── CheckoutController.php   # Checkout process
│   │   │   ├── OrderController.php      # Order management
│   │   │   └── ProductController.php    # Product CRUD
│   │   └── Middleware/
│   │       └── AdminMiddleware.php      # Admin access control
│   └── Models/
│       ├── Category.php
│       ├── Order.php
│       ├── Product.php
│       └── User.php
├── database/
│   └── migrations/            # Database schema
├── resources/
│   └── views/                 # Blade templates
│       ├── admin/               # Admin panel views
│       ├── auth/                # Login/Register
│       ├── layouts/             # Base layouts
│       ├── checkout.blade.php
│       ├── product-details.blade.php
│       ├── shop.blade.php
│       └── about.blade.php
├── routes/
│   └── web.php                  # Application routes
└── ecommerce_elite.sql          # Database dump
```

---

## Features & Routes

### Customer Routes

| Route | Method | Description |
|-------|--------|-------------|
| `/` | GET | Shop homepage with products |
| `/product/{slug}` | GET | Product details page |
| `/checkout` | GET | Checkout page (auth required) |
| `/place-order` | POST | Submit order (auth required) |
| `/about` | GET | About page |

### Authentication Routes

| Route | Method | Description |
|-------|--------|-------------|
| `/login` | GET/POST | User login |
| `/register` | GET/POST | User registration |
| `/logout` | POST | User logout |

### Admin Routes (Prefix: `/admin`)

| Route | Method | Description |
|-------|--------|-------------|
| `/admin/dashboard` | GET | Admin dashboard with stats |
| `/admin/products` | GET/POST | List/Create products |
| `/admin/products/create` | GET | Create product form |
| `/admin/products/{id}/edit` | GET | Edit product form |
| `/admin/products/{id}` | PUT/PATCH | Update product |
| `/admin/products/{id}` | DELETE | Delete product |
| `/admin/orders` | GET | List all orders |
| `/admin/orders/{order}/status` | PATCH | Update order status |
| `/admin/orders/{order}` | DELETE | Delete order |

---

## Database Schema

### Users Table
- `id`, `name`, `email`, `password`, `is_admin`, `timestamps`

### Products Table
- `id`, `category_id`, `name`, `slug`, `description`, `price`, `image`
- `is_ai_enabled` (boolean), `colors` (JSON), `sizes` (JSON), `timestamps`

### Orders Table
- `id`, `user_id`, `city`, `street`, `details`, `total_price`
- `items` (JSON), `status`, `timestamps`

### Categories Table
- `id`, `name`, `timestamps`

---

## Admin Access

To create an admin user:

```php
// In database or tinker
$user = User::find(1);
$user->is_admin = true;
$user->save();
```

Or update the `is_admin` column directly in the database.

---

## Development

### Watch for Changes

```bash
npm run dev
```

### Run Tests

```bash
php artisan test
```

### Code Style

```bash
composer run lint        # Check code style
composer run lint-fix    # Fix code style issues
```

---

## Deployment

### Production Setup

1. **Environment**: Set `APP_ENV=production` and `APP_DEBUG=false`

2. **Optimize**:
   ```bash
   php artisan config:cache
   php artisan route:cache
   php artisan view:cache
   php artisan event:cache
   ```

3. **Queue Worker** (if using):
   ```bash
   php artisan queue:work
   ```

4. **Set Permissions**:
   ```bash
   chmod -R 775 storage bootstrap/cache
   chown -R www-data:www-data storage bootstrap/cache
   ```

---

## Troubleshooting

### Common Issues

**Route caching error:**
```bash
php artisan route:clear
php artisan route:cache
```

**Storage link broken:**
```bash
php artisan storage:unlink
php artisan storage:link
```

**Permission denied:**
```bash
chmod -R 775 storage bootstrap/cache
```

---

## Contributing

1. Fork the repository
2. Create your feature branch (`git checkout -b feature/amazing-feature`)
3. Commit your changes (`git commit -m 'Add some amazing feature'`)
4. Push to the branch (`git push origin feature/amazing-feature`)
5. Open a Pull Request

---

## License

This project is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).

---

<p align="center">
  Made with ❤️ by Mohamed Mehana
</p>

