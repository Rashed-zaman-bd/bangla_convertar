# All Bangla Newspaper: responsive + dynamic Laravel starter

This package provides a database-driven public page and basic authenticated admin CRUD for newspaper categories and newspaper links.

## Before installing
- Back up your Laravel project and database.
- Check that you do not already have tables named `newspaper_categories` or `newspapers`. If they exist, adapt the migrations instead of running duplicate table creation.
- This uses Laravel's standard `auth` middleware for the admin routes. Install/configure authentication first (for example, Laravel Breeze) or replace the middleware with your existing admin middleware.
- Merge `routes/web.php` into your existing routes; do not overwrite unrelated routes.

## Install
1. Copy package files into matching paths in your Laravel project.
2. Merge `routes/web.php` into your project's `routes/web.php`.
3. Run:
```bash
php artisan migrate
php artisan storage:link
php artisan optimize:clear
php artisan serve
```
4. Open `/` for the public page.
5. Sign in and visit `/admin/newspaper-categories` or `/admin/newspapers`.

## Uploads
Newspaper logos are stored on Laravel's public disk, under `storage/app/public/newspaper-logos`. The public URL is generated with `Storage::url()`. Run `php artisan storage:link`.

## Notes
- Protect admin routes with your real admin/role middleware in production. `auth` only means a logged-in user.
- The package includes no authentication screens.
- Seed your database through the admin forms. Some sample records from your old array can be inserted later using a seeder.
- URL `#` is treated as a placeholder and not opened in a new tab.
