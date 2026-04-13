# KMH Academics – Kathmandu Model Hospital Institute of Health Sciences

A complete Laravel 12 + Vue 3 (Inertia.js) web application for KMH Academics.

## Tech Stack

- **Backend**: Laravel 12, PHP 8.2+
- **Frontend**: Vue 3 (Composition API `<script setup>`)
- **SPA**: Inertia.js v2
- **CSS**: TailwindCSS v4
- **Auth**: Custom auth + Spatie Laravel Permission
- **Database**: SQLite (dev), MySQL (production)
- **Build**: Vite 6

## Features

### Public Website
- Home page with banner carousel, latest notices, upcoming events
- About page with vision/mission/values, leadership message
- Programs/Courses listing with category filter + detail pages
- Notices/News with search, category filter, pagination
- Events & Trainings (upcoming/past tabs)
- Downloads/Resources with search and category filter
- FAQ accordion by category
- Contact form with honeypot spam protection

### Admin CMS
- Secure login (admin/editor roles)
- Dashboard with stats, recent messages, quick actions
- Full CRUD: Banners, Programs, Notices, Events, Downloads, FAQs, Pages
- File/image upload with storage management
- User management with role assignment
- Contact message inbox

## Installation

```bash
# Clone and install
composer install
npm install

# Configure
cp .env.example .env
php artisan key:generate

# Database
touch database/database.sqlite
php artisan migrate
php artisan db:seed

# Storage
php artisan storage:link

# Build assets
npm run build
```

## Default Credentials

- **Admin**: admin@kmh.edu.np / admin123!
- **Editor**: editor@kmh.edu.np / editor123!

Login at: `/admin/login`

## Development

```bash
npm run dev
php artisan serve
```

## Colors

- Primary Blue: `#1e40af`
- Accent Red: `#dc2626`

---
*Powered by [Venture Four Technology](https://venturefour.com.np)*
