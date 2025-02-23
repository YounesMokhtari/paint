# پروژه لاراول

## پیش‌نیازها

قبل از اجرای این پروژه، اطمینان حاصل کنید که موارد زیر نصب شده‌اند:

-   **PHP** (نسخه ۸.۰ یا جدیدتر)
-   **Composer**
-   **MySQL / PostgreSQL / SQLite**
-   **Node.js و NPM**

## نصب

۱. **کلون کردن مخزن:**

```bash
git clone git@github.com:YounesMokhtari/paint.git
cd paint
```

۲. **نصب وابستگی‌ها:**

```bash
composer install
npm install
```

۳. **تنظیم متغیرهای محیطی:**

```bash
cp .env.example .env
```

فایل `.env` را با اطلاعات دیتابیس و سایر تنظیمات خود به‌روزرسانی کنید.

۴. **تولید کلید اپلیکیشن:**

```bash
php artisan key:generate
```

۵. **اجرای مهاجرت‌ها و Seeders:**

```bash
php artisan migrate:fresh --seed
```

## اجرای پروژه

### بک‌اند (Laravel)

```bash
php artisan serve
```

این دستور سرور را در `http://127.0.0.1:8000` اجرا می‌کند.

### فرانت‌اند (در صورت استفاده از Vue یا React با Vite)

```bash
npm run dev
```

## ریست کردن دیتابیس

برای ریست کردن دیتابیس و اجرای مجدد مهاجرت‌ها:

```bash
php artisan migrate:refresh --seed
```

## رفع مشکلات احتمالی

-   در صورت نیاز به پاک کردن کش تنظیمات:
    ```bash
    php artisan config:clear
    php artisan cache:clear
    ```
-   حل مشکلات مربوط به مجوزها (در لینوکس/macOS):
    ```bash
    chmod -R 777 storage bootstrap/cache
    ```

## مجوز

[MIT](LICENSE)
