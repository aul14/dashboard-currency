## Aplikasi Dashboard Currency Exchange Rates (LARAVEL 9), Menggunakan API https://app.exchangerate-api.com/

## Cara menjalankan aplikasi
1. Clone atau download aplikasi ini.
2. Buka terminal atau command prompt, silahkan pindahkan ke directory file aplikasi ini.
3. Ketik command "composer install", tunggu proses sampai selesai
4. Ketik command "cp .env.example .env"
5. Ketik command "php artisan key:generate"
6. Setelah itu buka file .env tsb, dan edit beberapa konfigurasi
    1. API_KEY_EXCHANGERATE= (Isi dengan key yg sudah di dapatkan dari API https://app.exchangerate-api.com/)
    2. DB_DATABASE=(Sesuaikan nama database yg sudah dibuat, jika belum dibuat silahkan buat terlebih dahulu    databasenya), DB_USERNAME=(Sesuaikan db usernamenya), DB_PASSWORD=(Jika database di password silahkan diisi)
7. Setelah itu ketik command "php artisan migrate --seed"
8. Setelah itu ketik command "php artisan serve", untuk menjalankan aplikasi tsb.

## User login default role admin
1. email=admin@gmail.com
2. password=admin

## User login default role user
1. email=user@gmail.com
2. password=user
    