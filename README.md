# zayShop Laravel Project

# 🛍️ ZayShop - پروژه فروشگاه اینترنتی با Laravel

ZayShop یک فروشگاه اینترنتی پیشرفته و ساخت‌یافته است که با فریم‌ورک Laravel توسعه داده شده. این پروژه قابلیت‌های فروشگاهی، پنل مدیریت، و تحلیل داده را با طراحی تمیز و تجربه کاربری روان ارائه می‌دهد.

---

## ✨ امکانات کلیدی پروژه

### 🔐 پنل مدیریت و پنل کاربران
- پنل یکسان برای ادمین و کاربران با سطح دسترسی متفاوت
- کاربران فقط به اطلاعات شخصی خود دسترسی دارند
- مدیر به کلیه بخش‌های سیستم نظارت دارد (محصولات، سفارشات، کاربران و...)

### 🛒 فروشگاه و خرید
- لیست محصولات با فیلترهای حرفه‌ای:
  - جستجو
  - فیلتر رنگ و سایز با چک‌باکس
  - فیلتر بازه قیمت
  - دسته‌بندی
  - مرتب‌سازی (بر اساس قیمت، محبوبیت و...)

- سبد خرید کامل با قابلیت:
  - افزودن/حذف/ویرایش
  - نمایش مجموع قیمت‌ها

- لیست علاقه‌مندی‌ها برای هر کاربر

- پرداخت آفلاین در محیط توسعه (محلی)

---

## 📊 تجزیه و تحلیل در پنل مدیریت

- چارت‌های نمایش درآمد روزانه، هفتگی و ماهانه
- لیست:
  - محصولات پرفروش
  - دسته‌بندی‌های برتر
  - رنگ‌ها و سایزهای محبوب
  - محصولات ناموجود
  - محصولات محبوب در علاقه‌مندی‌ها و سبد خرید

- نمایش خلاصه اطلاعات کلیدی (کارت‌های آماری):
  - تعداد کاربران
  - درآمد امروز
  - تعداد سفارشات اخیر

---

## 📝 بلاگ (در حال توسعه)
- ساختار بلاگ با قابلیت انتشار مقاله
- دسته‌بندی، نمایش تاریخ شمسی، تعداد بازدید، کامنت‌گذاری

---

## 🚧 وضعیت پروژه

این پروژه هنوز در حال توسعه است و برخی قابلیت‌ها مانند سیستم بلاگ در حال تکمیل شدن هستند. در حال حاضر بخش‌های اصلی مانند:
- ثبت‌نام و ورود کاربران با تعیین سطح دسترسی
- سبد خرید، علاقه‌مندی‌ها، و پرداخت آفلاین (لوکال)
- پنل ادمین با تحلیل فروش، محصولات پرفروش و فیلترهای دقیق

پیاده‌سازی شده‌اند.


## ⚙️ تکنولوژی‌های استفاده‌شده

- Laravel 10
- PHP 8.x
- MySQL
- Bootstrap
- jQuery + Ajax
- Blade Template
- Chart.js

---

## 📁 نصب پروژه

```bash
git clone https://github.com/EhsanSafari485/zayshop_laravel.git
cd zayshop_laravel
composer install
cp .env.example .env
php artisan key:generate
php artisan migrate --seed
php artisan serve
