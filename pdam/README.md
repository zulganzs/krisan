# EcoWater - Sistem Manajemen Utilitas Air Lokal

EcoWater adalah aplikasi web modern dwibahasa (Inggris/Indonesia) untuk mengelola utilitas air lokal. Aplikasi ini memungkinkan pengguna melihat tarif, mensimulasikan tagihan, dan mengelola penggunaan air mereka, sambil menyediakan alat bagi administrator untuk mengawasi sistem.

![Halaman Utama EcoWater](file:///C:/Users/omega/.gemini/antigravity/brain/8ff04338-ac31-4d72-939f-6c86604b98b0/landing_page_1764527364100.png)

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

## Instalasi

1.  **Kloning repositori:**
    ```bash
    git clone <repository-url>
    cd pdam
    ```

2.  **Instal dependensi PHP:**
    ```bash
    composer install
    ```

3.  **Instal dependensi Node.js:**
    ```bash
    npm install
    ```

4.  **Pengaturan Lingkungan:**
    Salin file `.env.example` ke `.env`:
    ```bash
    cp .env.example .env
    ```
    Perbarui file `.env` dengan kredensial database Anda:
    ```env
    DB_CONNECTION=mysql
    DB_HOST=127.0.0.1
    DB_PORT=3306
    DB_DATABASE=pdam
    DB_USERNAME=root
    DB_PASSWORD=
    ```

5.  **Hasilkan Kunci Aplikasi:**
    ```bash
    php artisan key:generate
    ```

6.  **Jalankan Migrasi dan Seeder:**
    Ini akan menyiapkan tabel database dan mengisinya dengan data awal (termasuk tarif dan pengguna admin).
    ```bash
    php artisan migrate --seed
    ```

7.  **Bangun Aset Frontend:**
    ```bash
    npm run build
    ```

## Menjalankan Aplikasi

1.  **Mulai server pengembangan lokal:**
    ```bash
    php artisan serve
    ```

2.  **Akses aplikasi:**
    Buka browser Anda dan kunjungi [http://127.0.0.1:8000](http://127.0.0.1:8000).

## Kredensial Pengujian

**Akun Admin:**
-   **Email:** `admin@ecowater.local`
-   **Kata Sandi:** `password`

**Pengguna Biasa:**
-   Anda dapat mendaftarkan akun baru melalui tautan "Daftar" di kanan atas.

## Fungsionalitas Utama

-   **Pengalih Bahasa:** Klik tombol "EN" atau "ID" di bilah navigasi atas untuk mengganti bahasa.
-   **Simulator Tagihan:** Navigasi ke "Kalkulator Tagihan" untuk memperkirakan biaya.
    -   *Contoh:* Sebelumnya: 100, Saat Ini: 115 -> Pemakaian: 15m³ (Tarif Tingkat 2 diterapkan).
-   **Halaman Tarif:** Lihat tingkat harga saat ini di "Tarif & Harga".

## Pemecahan Masalah

-   **Pengalih Bahasa Mengalihkan Secara Tidak Benar:** Jika mengklik tombol bahasa mengalihkan Anda secara tidak terduga, coba navigasi manual kembali ke halaman yang diinginkan. Pengaturan bahasa harus tetap ada.
-   **Kesalahan Halaman Tarif:** Jika Anda menemukan kesalahan "Malformed @foreach", coba mulai ulang server (`Ctrl+C` lalu `php artisan serve`) untuk membersihkan cache tampilan.

## Lisensi

Kerangka kerja Laravel adalah perangkat lunak sumber terbuka yang dilisensikan di bawah [lisensi MIT](https://opensource.org/licenses/MIT).
