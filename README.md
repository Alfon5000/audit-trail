# Cara Install

- Pastikan sudah terinstall PHP versi 8.2-8.3, Node.js versi 18.x atau lebih, PostgreSQL, Composer versi 2.x, dan Git di perangkat Anda.
- Buka terimal Git pada direktori perangkat Anda kemudian jalankan perintah berikut pada terimal Git Anda: `git clone https://github.com/Alfon5000/audit-trail.git`.
- Setelah proses cloning selesai, masuk ke dalam folder project dengan menjalankan perintah berikut pada terimal Git Anda: `cd audit-trail\`.
- Jalankan perintah berikut untuk menyalin file .env: `cp .env.example .env`.
- Buka file .env menggunakan text editor Anda, lakukan konfigurasi database sesuai database yang ingin digunakan.
- Jalankan perintah `composer install` dan `npm install` untuk men-download dan meng-install seluruh package dan library yang digunakan pada aplikasi ini.
- Jalankan perintah `php artisan migrate --seed` untuk melakukan migrate dan seed database.
- Jalankan perintah `php artisan key:generate` untuk men-generate kunci enkripsi aplikasi Laravel.
- Jalankan perintah `php artisan serve` untuk menjalankan aplikasi Laravel dan `npm run dev` untuk menjalankan aplikasi Vue.js.
- Jalankan URL berikut di web browser Anda http://localhost:8000 atau http://127.0.0.1:8000

# Daftar Akun

- Admin (Akses Penuh)
  - Email: admin@email.com
  - Password: password
- User (Akses Terbatas)
  - Email: user@email.com
  - Password: password
