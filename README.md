# Domain Monitor

Admin panel for automatic domain availability monitoring.

## Features

- User authentication (register, login, logout)
- Add, edit, delete domains
- Configurable check interval, timeout, HTTP method (GET/HEAD)
- Automatic domain checks via Laravel Scheduler + Queue
- Check history with status, HTTP code, response time, errors

## Tech Stack

- PHP 8.2+
- Laravel 12
- MySQL 8
- Bootstrap 5

## Local Setup

### Requirements

- PHP 8.2+
- Composer
- MySQL 8+

### Installation
```bash
git clone https://github.com/your-username/admin-panel.git
cd domain-monitor

composer install

cp .env.example .env
php artisan key:generate
```

Configure `.env`:
```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=admin-panel
DB_USERNAME=root
DB_PASSWORD=

QUEUE_CONNECTION=database
```
```bash
php artisan migrate
php artisan queue:table
php artisan migrate
```

### Running locally
```bash
php artisan serve

# In separate terminals:
php artisan queue:work
php artisan schedule:work
```

## Demo

[https://your-demo-link.up.railway.app](https://your-demo-link.up.railway.app)

**Test credentials:**
- Email: `demo@example.com`
- Password: `password`


## Notifications

Users receive email notifications when a domain changes status (UP → DOWN or DOWN → UP).

Configure mail settings in `.env`:
```env
MAIL_MAILER=smtp
MAIL_HOST=sandbox.smtp.mailtrap.io
MAIL_PORT=2525
MAIL_USERNAME=your_username
MAIL_PASSWORD=your_password
MAIL_FROM_ADDRESS=monitor@example.com
MAIL_FROM_NAME="Domain Monitor"
```
