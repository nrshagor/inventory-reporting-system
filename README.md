# 📦 Inventory & Financial Reporting System

This is a Laravel 12-based simple inventory management system with full accounting journals and financial reporting features.

---

## Features

-   ✅ Product Management (Create + Stock)
-   ✅ Sale Module (Multi-product, discount, VAT, due)
-   ✅ Accounting Journal (Sales, Discount, VAT, Payment)
-   ✅ Financial Reports (Date-wise filter, profit calculation)
-   ✅ Clean UI with Blade + Tailwind + Dark Mode
-   ✅ Responsive, mobile-friendly layout

---

## Tech Stack

-   Laravel 12
-   PHP 8.2
-   MySQL
-   Tailwind CSS
-   Laravel Breeze (for auth + UI)

---

## ⚙Installation Instructions

### 1. Clone the project

```bash
git clone https://github.com/nrshagor/inventory-reporting-system.git
cd inventory-system
```

### 2. Install dependencies

```bash
composer install
npm install && npm run dev
```

### 3. Environment Setup

```bash
cp .env.example .env
php artisan key:generate
```

### 4. Update .env File

```bash
APP_NAME=InventorySystem
APP_URL=http://inventory-system.local:8000

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=inventory_system
DB_USERNAME=root
DB_PASSWORD=

# Set Breeze session correctly
SESSION_DOMAIN=.local
SESSION_COOKIE=shared_session
```

### 5. Hosts File Configuration (For APP_URL)

#### Make sure to point inventory-system.local in your OS hosts file:

```bash
# Windows: C:\Windows\System32\drivers\etc\hosts
# Linux/Mac: /etc/hosts

127.0.0.1 inventory-system.local
```

### 6. Serve the App

#### Run the local development server with a custom port:

```bash
php artisan serve --host=inventory-system.local --port=8000
```

#### Access: http://inventory-system.local:8000

### 7. Create Database

#### Create the database in MySQL:

```bash
CREATE DATABASE inventory_system;
```

### Run Migrations and Seed Default Products

```bash
php artisan migrate --seed

```

#### If Default product not seed used this command

```bash
php artisan db:seed --class=ProductSeeder
```

#### This will:

-   Create all necessary tables
-   Seed 10 default products with:
-   Purchase Price: 100 TK
-   Sell Price: 200 TK
-   Stock: 50 units

### Available Pages

| Route       | Description                |
| :---------- | :------------------------- |
| `/login	`    | Auth Login/Register        |
| `/products	` | Add product + product list |
| `/sales	`    | Create sale                |
| `/report	`   | View financial report      |

### API Endpoints

| Method | Endpoint        | Description              |
| :----- | :-------------- | :----------------------- |
| `GET`  | `/api/products` | Get product list         |
| `POST` | `/api/sales`    | Submit sale entry        |
| `POST` | `/api/report`   | Get report by date range |

## Developer Info

#### Noore Rabbi Shagor

#### noorerabbishagor@gmail.com

#### https://nrshagor.com
