# 📚 Perpustakaan Sekolah SMPN 26 Kota Jambi

[![Laravel](https://img.shields.io/badge/Laravel-12.x-orange.svg)](https://laravel.com)
[![PHP](https://img.shields.io/badge/PHP-8.2+-purple.svg)](https://php.net)
[![MySQL](https://img.shields.io/badge/MySQL-8.0+-blue.svg)](https://mysql.com)
[![License](https://img.shields.io/badge/License-MIT-blue.svg)](LICENSE)

## 🚀 Instalasi

### Prasyarat
- PHP 8.2+
- Composer 2.2+
- MySQL 8.0+

### Langkah 1: Clone Repositori
```bash
git clone https://github.com/rickyylaa/perpustakaan-smpn-26-kota-jambi.git
cd perpustakaan-smpn-26-kota-jambi
```

### Langkah 2: Install Dependensi
```bash
composer install
```

### Langkah 3: Konfigurasi Environment
```bash
cp .env.example .env
php artisan key:generate

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=perpustakaan
DB_USERNAME=root
DB_PASSWORD=
```

### Langkah 4: Database Setup
```bash
php artisan migrate
php artisan db:seed
```

### Langkah 5: Optimasi 2x
```bash
php artisan optimize
php artisan optimize
```

### Langkah 6: Storage Link
```bash
php artisan storage:link
```

### Langkah 7: Jalankan Aplikasi
```bash
php artisan serve
```
