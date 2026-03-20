# IntertransitLogistics — Laravel App

A full-featured logistics and freight management platform built with Laravel 10.

## ✨ Features

### Frontend (Public Site)
- **Homepage** with hero, stats counter, services grid, process steps, testimonials, team
- **Services** pages (index + dynamic detail per service)
- **About** page with team section
- **Contact** form with database storage
- **Track & Trace** — live shipment tracking by tracking number with visual timeline
- **AOS animations** throughout, responsive mobile design
- **Dynamic app name** read from DB settings or `.env`

### Admin Panel (`/admin`)
- **Dashboard** with stats cards, recent shipments, unread messages
- **Shipments CRUD** — create, view, edit, delete shipments + add/remove tracking events
- **Services CRUD** — manage all services shown on the website
- **Testimonials CRUD** — manage customer reviews
- **Team Members CRUD** — manage who appears on About/Home pages
- **Messages** — view and manage contact form submissions
- **Settings** — tabbed settings panel (General, Social, Homepage, SEO) stored in DB
- **Profile** — update admin name, email, password

---

## 🚀 Deployment (Shared Hosting / cPanel)

### Step 1 — Upload Files
Upload the project files to your server. Place all files **except the `public` folder** outside your `public_html`. Place the contents of `public` inside `public_html`.

```
/home/youraccount/
├── logistics-app/          ← project root (outside public_html)
│   ├── app/
│   ├── bootstrap/
│   ├── config/
│   ├── database/
│   ├── resources/
│   ├── routes/
│   ├── storage/
│   ├── vendor/
│   └── ...
└── public_html/            ← or your domain's document root
    ├── index.php           ← modified (see below)
    ├── .htaccess
    └── storage/            ← symlink
```

### Step 2 — Modify `public_html/index.php`
Change the paths to point to your project root:

```php
require __DIR__.'/../logistics-app/vendor/autoload.php';

(require_once __DIR__.'/../logistics-app/bootstrap/app.php')
    ->handleRequest(Request::capture());
```

### Step 3 — Create Database
1. In cPanel → MySQL Databases, create a new database and user
2. Grant the user ALL PRIVILEGES on the database

### Step 4 — Configure `.env`
Copy `.env.example` to `.env` and fill in:

```env
APP_NAME="IntertransitLogistics"
APP_URL=https://yourdomain.com
APP_KEY=                    # will be generated in step 5

DB_HOST=localhost
DB_DATABASE=your_db_name
DB_USERNAME=your_db_user
DB_PASSWORD=your_db_password
```

### Step 5 — Run Artisan Commands (via SSH or cPanel Terminal)

```bash
cd /path/to/logistics-app

# Install dependencies (if vendor/ not included)
composer install --optimize-autoloader --no-dev

# Generate app key
php artisan key:generate

# Run migrations + seed demo data
php artisan migrate --seed

# Create storage symlink
php artisan storage:link

# Cache config for performance (optional)
php artisan config:cache
php artisan route:cache
php artisan view:cache
```

### Step 6 — Set Permissions
```bash
chmod -R 755 storage/
chmod -R 755 bootstrap/cache/
```

---

## 🔐 Default Admin Login

```
URL:      https://yourdomain.com/admin
Email:    admin@logistics.com
Password: password
```

> **Change the password immediately** after first login via Admin → My Profile.

---

## 🛠 Local Development

```bash
# Clone / extract the project
cd logistics-app

# Install PHP dependencies
composer install

# Setup environment
cp .env.example .env
php artisan key:generate

# Configure DB in .env, then:
php artisan migrate --seed

# Create storage link
php artisan storage:link

# Start dev server
php artisan serve
# → http://localhost:8000
# → http://localhost:8000/admin
```

---

## 📁 Project Structure

```
app/
├── Http/
│   ├── Controllers/
│   │   ├── HomeController.php          # Frontend pages
│   │   ├── TrackingController.php      # Public tracking
│   │   └── Admin/
│   │       ├── AuthController.php      # Login/logout/profile
│   │       ├── DashboardController.php
│   │       ├── ShipmentController.php  # Full CRUD + events
│   │       ├── ServiceController.php
│   │       ├── TestimonialController.php
│   │       ├── TeamMemberController.php
│   │       ├── MessageController.php
│   │       └── SettingController.php
│   └── Middleware/
│       └── AdminMiddleware.php
├── Models/
│   ├── User.php
│   ├── Setting.php        # DB-backed settings with cache
│   ├── Shipment.php       # With status labels + tracking #
│   ├── TrackingEvent.php
│   ├── Service.php
│   ├── Testimonial.php
│   ├── TeamMember.php
│   └── ContactMessage.php
└── Helpers/
    └── SettingHelper.php  # setting(), app_name() helpers

database/
├── migrations/            # All tables
└── seeders/
    └── DatabaseSeeder.php # Demo data + admin user

resources/views/
├── layouts/
│   ├── app.blade.php      # Frontend layout (navbar, footer, AOS)
│   └── admin.blade.php    # Admin layout (sidebar, header)
├── frontend/
│   ├── home.blade.php
│   ├── about.blade.php
│   ├── tracking.blade.php
│   ├── contact.blade.php
│   └── services/
│       ├── index.blade.php
│       └── show.blade.php
└── admin/
    ├── auth/login.blade.php
    ├── auth/profile.blade.php
    ├── dashboard.blade.php
    ├── shipments/ (index, create, edit, show, _form)
    ├── services/  (index, create, edit, _form)
    ├── testimonials/ (index, create, edit, _form)
    ├── team/ (index, create, edit, _form)
    ├── messages/ (index, show)
    └── settings/index.blade.php
```

---

## 🧩 Tracking Number Format
Auto-generated tracking numbers follow format: `ITL` + 9 random uppercase alphanumeric chars  
Example: `ITLA3F72KX9`

Demo tracking number for testing: **ITLDEMO001**

---

## ⚙️ Customization

### Change App Name
**Option 1** — `.env` file:
```env
APP_NAME="Your Company Name"
```

**Option 2** — Admin Dashboard → Settings → General → Application Name  
(DB setting takes priority over `.env`)

### Add New Service
Admin → Services → New Service → fill title, icon (Font Awesome class), description → Save

### Add Tracking Event
Admin → Shipments → click any shipment → use "Add Tracking Event" form on the right side

---

## 📦 Tech Stack

| Layer      | Technology                          |
|------------|-------------------------------------|
| Backend    | Laravel 10 (PHP 8.1+)               |
| Frontend   | Bootstrap 5.3, AOS.js, Font Awesome |
| Fonts      | Barlow + Barlow Condensed (Google)  |
| Database   | MySQL / SQLite                      |
| Auth       | Laravel Session Auth                |
| Storage    | Laravel Filesystem (public disk)    |

---

## 📝 License
MIT — Free to use and modify.
