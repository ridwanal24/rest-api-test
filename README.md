# Laravel JWT Basic Setup

Project ini adalah setup dasar Laravel dengan autentikasi JWT menggunakan php-open-source-saver/jwt-auth.

## 1. Clone Project

git clone https://github.com/ridwanal24/rest-api-test.git
cd rest-api-test

## 2. Install Dependency

composer install

## 3. Setup Environment

Rename file .env.example menjadi .env

cp .env.example .env

Generate application key:

php artisan key:generate

## 4. Konfigurasi Database

Buka file .env, lalu ubah bagian DB_CONNECTION menjadi MySQL dan sesuaikan dengan environment lokal anda:

DB_CONNECTION=sqlite
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=laravel
DB_USERNAME=root
DB_PASSWORD=

Pastikan:

- Database sudah dibuat terlebih dahulu
- Username & password sesuai dengan konfigurasi MySQL kamu

Jika database belum ada, buat terlebih dahulu:

CREATE DATABASE laravel;

## 5. Setup JWT

Publish config JWT:

php artisan vendor:publish --provider="PHPOpenSourceSaver\\JWTAuth\\Providers\\LaravelServiceProvider"

Generate JWT Secret:

php artisan jwt:secret

## 6. Migrasi Database

php artisan migrate

## 7. Seeder (Data Awal)

php artisan db:seed

## 8. Jalankan Server

php artisan serve

Akses aplikasi di:

http://127.0.0.1:8000

Selesai. Project Laravel dengan JWT sudah siap digunakan.
