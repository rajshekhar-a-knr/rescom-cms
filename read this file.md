# Rescom - Complete Laravel CMS
## Full IT Company Website with Admin Panel

---

## 🚀 QUICK SETUP GUIDE

### Prerequisites
- PHP 8.1+
- MySQL 8.0+ or MariaDB 10.4+
- Composer 2.x
- Node.js 18+ (optional, for Vite)
- Apache/Nginx web server

---

## 📦 STEP 1: Install Laravel Dependencies

```bash
# Navigate to project folder
cd rescom-cms

# Install PHP dependencies
composer install

# Copy environment file
cp .env.example .env

# Generate application key
php artisan key:generate
```

---

## 🗄️ STEP 2: Database Setup

### Option A: Import the SQL file directly (Recommended)
```bash
mysql -u root -p < database/knrint_complete.sql
```

### Option B: Create database manually
```sql
CREATE DATABASE rescom-cms CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
```

Then update `.env`:
```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=rescom-cms
DB_USERNAME=your_mysql_username
DB_PASSWORD=your_mysql_password
```

Then run migrations (if using Laravel migrations):
```bash
php artisan migrate
php artisan db:seed
```

---

## ⚙️ STEP 3: Configure Environment

Edit `.env` file with your settings:

```env
APP_NAME="Rescom"
APP_URL=https://www.rescom.in
APP_ENV=production
APP_DEBUG=false

# Database
DB_DATABASE=rescom-cms
DB_USERNAME=root
DB_PASSWORD=your_password

# Email (Gmail SMTP example)
MAIL_MAILER=smtp
MAIL_HOST=smtp.gmail.com
MAIL_PORT=587
MAIL_USERNAME=info@rescom.in
MAIL_PASSWORD=your_app_password
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS=info@rescom.in
MAIL_FROM_NAME="Rescom"
```

---

## 📁 STEP 4: File Permissions & Storage

```bash
# Set proper permissions
chmod -R 755 storage bootstrap/cache
chmod -R 777 storage/app/public

# Create storage symlink (allows public file access)
php artisan storage:link

# Clear all caches
php artisan config:clear
php artisan cache:clear
php artisan view:clear
php artisan route:clear
```

---

## 🌐 STEP 5: Web Server Configuration

### Apache (.htaccess - already included in public/)
The public/ folder should be the web root. Add to Apache config:
```apache
<VirtualHost *:80>
    ServerName www.rescom.in
    DocumentRoot /var/www/rescom-cms/public
    
    <Directory /var/www/rescom-cms/public>
        AllowOverride All
        Require all granted
    </Directory>
</VirtualHost>
```

### Nginx
```nginx
server {
    listen 80;
    server_name www.rescom.in;
    root /var/www/rescom-cms/public;
    
    index index.php index.html;
    
    location / {
        try_files $uri $uri/ /index.php?$query_string;
    }
    
    location ~ \.php$ {
        fastcgi_pass unix:/var/run/php/php8.1-fpm.sock;
        fastcgi_index index.php;
        fastcgi_param SCRIPT_FILENAME $realpath_root$fastcgi_script_name;
        include fastcgi_params;
    }
    
    location ~ /\.(?!well-known).* {
        deny all;
    }
}
```

---

## 🔑 STEP 6: Admin Access

**Admin Panel URL:** `https://www.rescom.in/admin`

**Default Credentials:**
```
Email:    admin@rescom.in
Password: password
```

> ⚠️ **IMPORTANT:** Change the password immediately after first login!
> Go to: Admin Panel → My Profile → Change Password

To set a custom password via terminal:
```bash
php artisan tinker
>>> \App\Models\User::find(1)->update(['password' => bcrypt('YourNewSecurePassword!')])
```

---

## 📋 WHAT'S INCLUDED

### Frontend Pages
- ✅ Homepage with animated hero slider
- ✅ About Us page with team section
- ✅ Services listing & individual service pages
- ✅ Portfolio with case studies
- ✅ Blog with categories, tags, search
- ✅ Careers with job listings & application form
- ✅ Contact page with Google Maps
- ✅ Privacy Policy & Terms of Service
- ✅ XML Sitemap

### Admin Panel Features
- ✅ Dashboard with stats & recent activity
- ✅ Hero Banner Management (with slider reordering)
- ✅ Services Management (CRUD + featured toggle)
- ✅ Portfolio Management (with client details)
- ✅ Blog Posts (with SimpleMDE rich editor)
- ✅ Team Members Management
- ✅ Testimonials Management
- ✅ Clients & Partners Management
- ✅ Stats/Counter Management
- ✅ FAQ Management
- ✅ Technologies Stack Management
- ✅ Custom Pages Builder
- ✅ Job Listings & Application Tracking
- ✅ Contact Inquiries with Email Reply
- ✅ Media Library (drag & drop upload)
- ✅ Newsletter Subscribers + CSV Export
- ✅ Site Settings (General, SEO, Social, Email)
- ✅ Multi-User Admin with Role Management
- ✅ Activity Logs

---

## 🎨 CUSTOMIZATION

### Colors
Edit CSS variables in `resources/views/layouts/app.blade.php`:
```css
:root {
    --primary: #0f4c81;       /* Main blue */
    --accent: #f97316;         /* Orange accent */
    --secondary: #06b6d4;      /* Cyan */
}
```

### Logo
Upload your logo via Admin Panel → Settings → General → Site Logo

### Add Images
Upload images via Admin Panel → Media Library

---

## 📱 RESPONSIVE BREAKPOINTS

- Desktop: 1280px+
- Tablet: 768px - 1024px
- Mobile: < 768px

---

## 🔧 PRODUCTION OPTIMIZATIONS

```bash
# Optimize for production
php artisan config:cache
php artisan route:cache
php artisan view:cache
php artisan event:cache

# Optimize composer autoload
composer install --optimize-autoloader --no-dev
```

---

## 📧 EMAIL SETUP

For Gmail SMTP, you need an App Password:
1. Go to Google Account → Security
2. Enable 2-Factor Authentication
3. Create App Password for "Mail"
4. Use that 16-character password in MAIL_PASSWORD

---

## 🛡️ SECURITY CHECKLIST

- [ ] Change default admin password
- [ ] Set APP_DEBUG=false in production
- [ ] Configure HTTPS/SSL
- [ ] Set proper file permissions (755 for directories, 644 for files)
- [ ] Configure firewall
- [ ] Enable CSRF protection (already enabled)
- [ ] Regular database backups

---

## 📞 SUPPORT

Website: www.rescom.in  
Email: info@rescom.in

---

## PROJECT STRUCTURE

```
rescom-cms/
├── app/
│   ├── Http/
│   │   ├── Controllers/
│   │   │   ├── Admin/          # All admin controllers
│   │   │   ├── HomeController.php
│   │   │   ├── ServiceController.php
│   │   │   ├── PortfolioController.php
│   │   │   ├── BlogController.php
│   │   │   ├── AboutController.php
│   │   │   ├── CareersController.php
│   │   │   └── ContactController.php
│   │   └── Middleware/
│   │       └── AdminMiddleware.php
│   ├── Models/                 # All Eloquent models
│   ├── helpers.php             # setting() helper function
│   └── Providers/
│       └── AppServiceProvider.php
├── database/
│   └── knrint_complete.sql   # Complete DB with seed data
├── resources/
│   └── views/
│       ├── layouts/
│       │   └── app.blade.php  # Main frontend layout
│       ├── pages/             # All public pages
│       └── admin/
│           ├── layouts/
│           │   └── app.blade.php  # Admin layout
│           ├── login.blade.php
│           └── pages/         # All admin pages
├── routes/
│   └── web.php               # All routes
├── .env.example
└── composer.json
```
