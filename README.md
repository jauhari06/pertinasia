# Pertinasia

**Pertinasia** adalah sebuah platform berbasis web yang dikembangkan menggunakan Laravel.Proyek ini bertempat di: [https://pertinasia.org/](https://pertinasia.org/).

## Teknologi yang Digunakan
* **Backend**: Laravel versi 8.2.4
* **Frontend**: Blade Template, bootstrap
* **Database**: MySQL
* **Hosting**: Cpanel

## Instalasi dan Pengaturan

1. Clone repository ini:
   ```bash
   git clone https://github.com/username/pertinasia.git
   ```

2. Masuk ke direktori proyek:
   ```bash
   cd pertinasia
   ```

3. Instal dependensi menggunakan Composer:
   ```bash
   composer install
   ```

4. Duplikasi file `.env.example` menjadi `.env`:
   ```bash
   cp .env.example .env
   ```

5. Atur konfigurasi database di file `.env`.

6. Generate application key:
   ```bash
   php artisan key:generate
   ```

7. Migrasi database:
   ```bash
   php artisan migrate
   ```

8. Jalankan server lokal:
   ```bash
   php artisan serve
   ```

   Akses website melalui `http://localhost:8000`.

