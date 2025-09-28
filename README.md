# Articles API

API sederhana berbasis Laravel untuk autentikasi pengguna, manajemen artikel, dan komentar.

## Fitur
- Register, Login, Logout dengan Laravel Sanctum.
- CRUD Artikel (create, read, update, delete).
- Komentar pada artikel.
- Pencarian artikel berdasarkan judul atau isi.

## Persyaratan
- PHP >= 8.2
- Composer
- MySQL / MariaDB
- Laravel 11
- Laravel Sanctum

## Instalasi
1. Clone repository:
   git clone https://github.com/shafamantasya17/articles-api.git
   cd articles-api
2. Install dependencies:
   composer install
3. Copy .env dan atur database:
   cp .env.example .env
   php artisan key:generate
4. Jalankan migrasi database:
   php artisan migrate
5. Jalankan server:
   php artisan serve

## Autentikasi
Gunakan header berikut untuk endpoint yang memerlukan login:

Authorization: Bearer {token}
Accept: application/json

Token didapat setelah login.

## Endpoint Utama

## Auth

| Method | Endpoint        | Keterangan                 |
|--------|----------------|----------------------------|
| POST   | /api/register   | Register pengguna baru     |
| POST   | /api/login      | Login, dapatkan token      |
| POST   | /api/logout     | Logout (hapus token saat ini) |

---

## Articles

| Method      | Endpoint                  | Keterangan                     |
|-------------|---------------------------|--------------------------------|
| GET         | /api/articles?search=keyword | List artikel (pencarian opsional) |
| POST        | /api/articles             | Tambah artikel baru (auth)     |
| GET         | /api/articles/{id}        | Detail artikel                 |
| PUT/PATCH   | /api/articles/{id}        | Update artikel (author saja)   |
| DELETE      | /api/articles/{id}        | Hapus artikel (author saja)    |

---

## Comments

| Method | Endpoint                          | Keterangan               |
|--------|----------------------------------|--------------------------|
| GET    | /api/articles/{article}/comments | List komentar artikel    |
| POST   | /api/articles/{article}/comments | Tambah komentar (auth)   |

## Testing
php artisan test