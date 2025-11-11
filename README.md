<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## Business Profile CMS (Laravel + Inertia Vue)

A simple business profile website with a lightweight CMS for managing landing page content (Hero, Services, Testimonials, Company Profile, Contact Info, and Settings).

### Tech Stack
- Laravel 12, PHP 8.3+
- Inertia.js + Vue 3 + Vite
- SQLite (local dev)

### Quick Start

Prerequisites:
- PHP 8.3+ and Composer
- Node.js 18+ and npm

Setup:
```bash
composer install
cp .env.example .env
php artisan key:generate
mkdir -p database && touch database/database.sqlite
php artisan migrate --seed
npm install
npm run dev
```

Login:
- Admin: `admin@example.com` / `password`

URLs:
- Public Landing: `http://localhost`
- Admin: `http://localhost/admin`

### Features
- Admin management for:
	- Hero Sections
	- Services
	- Testimonials
	- Company Profile
	- Contact Info
	- Settings

### Tests
Run feature tests:
```bash
php artisan test
```
Includes:
- Admin access control
- Landing page content rendering

### Next Ideas
Planned enhancements:
- Roles & granular permissions (spatie/laravel-permission)
- Media uploads (hero background, testimonial avatar) + image optimization
- Draft / publish workflow & revision history
- Drag & drop ordering for services & testimonials
- Global search panel in admin
- Public JSON API endpoints (cacheable)
- Caching layer for frequently read blocks (Redis)
- Dark mode toggle
- E2E tests (Laravel Dusk / Cypress)
- Deployment guide & CI pipeline (GitHub Actions)
