# EcoWater - Sistem Manajemen Utilitas Air Lokal

EcoWater adalah aplikasi web modern untuk mengelola utilitas air lokal. Aplikasi ini memungkinkan pengguna melihat tarif, mensimulasikan tagihan, dan mengelola penggunaan air mereka, sambil menyediakan alat bagi administrator untuk mengawasi sistem.

![Halaman Utama EcoWater](https://via.placeholder.com/800x400?text=EcoWater+Dashboard)

## Fitur

-   **Dukungan Dwibahasa:** Peralihan mulus antara Bahasa Inggris dan Bahasa Indonesia.
-   **Simulator Tagihan:** Hitung perkiraan tagihan bulanan berdasarkan pembacaan meteran dan harga bertingkat.
-   **Informasi Tarif:** Tampilan tarif air bertingkat yang jelas.
-   **Dasbor Pengguna:** Lihat riwayat penagihan dan statistik penggunaan.
-   **Dasbor Admin:** Kelola tiket dukungan dan lihat ikhtisar sistem.
-   **Desain Responsif:** UI modern yang dibangun dengan Tailwind CSS, dioptimalkan untuk desktop dan seluler.

## Prasyarat

Sebelum memulai, pastikan Anda telah menginstal:

-   **PHP** >= 8.2
-   **Composer**
-   **Node.js** & **NPM**
-   **MySQL**

## Mulai Cepat

Anda dapat menyiapkan proyek dengan cepat menggunakan skrip composer yang disertakan:

1.  **Kloning repositori:**
    ```bash
    git clone <repository-url>
    cd pdam
    ```

2.  **Jalankan skrip pengaturan:**
    Perintah ini menginstal dependensi, menyiapkan file lingkungan, menghasilkan kunci aplikasi, menjalankan migrasi, dan membangun aset frontend.
    ```bash
    composer run setup
    ```

3.  **Mulai server pengembangan:**
    Perintah ini menjalankan server Laravel, pendengar antrean, dan server pengembangan Vite secara bersamaan.
    ```bash
    composer run dev
    ```

    Akses aplikasi di [http://127.0.0.1:8000](http://127.0.0.1:8000).

---

## Instalasi Manual

Jika Anda lebih suka menyiapkan proyek secara manual, ikuti langkah-langkah berikut:

1.  **Instal dependensi PHP:**
    ```bash
    composer install
    ```

2.  **Instal dependensi Node.js:**
    ```bash
    npm install
    ```

3.  **Pengaturan Lingkungan:**
    Salin file contoh lingkungan dan konfigurasikan kredensial database Anda:
    ```bash
    cp .env.example .env
    ```
    Edit `.env` dan perbarui pengaturan database:
    ```env
    DB_CONNECTION=mysql
    DB_HOST=127.0.0.1
    DB_PORT=3306
    DB_DATABASE=pdam
    DB_USERNAME=root
    DB_PASSWORD=
    ```

4.  **Hasilkan Kunci Aplikasi:**
    ```bash
    php artisan key:generate
    ```

5.  **Jalankan Migrasi dan Seeder:**
    Ini menyiapkan tabel database dan mengisinya dengan data awal (tarif, pengguna admin).
    ```bash
    php artisan migrate --seed
    ```

6.  **Bangun Aset Frontend:**
    ```bash
    npm run build
    ```

7.  **Jalankan Aplikasi:**
    ```bash
    php artisan serve
    ```

## Menjalankan Pengujian

Untuk menjalankan pengujian otomatis:

```bash
php artisan test
```

## Kredensial Default

**Akun Admin:**
-   **Email:** `admin@ecowater.local`
-   **Kata Sandi:** `password`

**Pengguna Biasa:**
-   Anda dapat mendaftarkan akun baru melalui tautan "Daftar" di pojok kanan atas.

## Pemecahan Masalah

-   **Masalah Pengalih Bahasa:** Jika mengklik tombol bahasa mengalihkan secara tidak terduga, coba navigasi manual kembali ke halaman yang diinginkan.
-   **Kesalahan Tampilan (View Errors):** Jika Anda menemukan kesalahan tampilan, coba bersihkan cache tampilan:
    ```bash
    php artisan view:clear
    ```
