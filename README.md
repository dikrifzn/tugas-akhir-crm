# 🧵 Sundara Batik - Aplikasi E-Commerce Batik

**Sundara Batik** adalah platform e-commerce berbasis web yang dibangun dengan Laravel dan Blade. Aplikasi ini dirancang untuk memudahkan pelanggan dalam menjelajahi dan membeli berbagai produk batik secara online, serta menyediakan sistem pengelolaan pesanan, keranjang, voucher, dan pengiriman.

---

## 🚀 Fitur Utama

- ✅ Registrasi & Login Customer
- 🛍️ Daftar Produk dengan Variasi Ukuran
- 🛒 Keranjang Belanja
- 🎫 Voucher Diskon (Fixed / Persentase)
- 🧾 Checkout & Konfirmasi Pembayaran
- 📦 Manajemen Pesanan & Status Pengiriman
- 📍 Manajemen Alamat Pengiriman
- 🎯 Filter Produk berdasarkan Ukuran, Gender, dan Harga

---

## 🛠️ Teknologi yang Digunakan

- **Backend**: [Laravel 12](https://laravel.com/)
- **Frontend**: Blade + Tailwind CSS
- **Authentication**: Laravel Auth
- **Database**: MySQL
- **Admin Panel**: Filament

---

## 📁 Struktur Direktori

```
.
├── app/
├── database/
│   └── migrations/
├── public/
│   └── image/product/
├── resources/
│   └── views/
├── routes/
│   └── web.php
├── .env
└── README.md
```

---

## ⚙️ Cara Install & Jalankan

### 1. Clone Repositori

```bash
git clone https://github.com/dikrifzn/tugas-akhir-crm.git
cd tugas-akhir-crm
```

### 2. Install Dependency

```bash
composer install
npm install
npm run dev
```

### 3. Konfigurasi Environment

```bash
cp .env.example .env
php artisan key:generate
```

Edit `.env` untuk koneksi database MySQL, contoh:

```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=sundarabatik
DB_USERNAME=root
DB_PASSWORD=
```

### 4. Migrasi & Seeder Database

```bash
php artisan migrate --seed
```

### 5. Jalankan Server Laravel

```bash
php artisan serve
```

Buka di browser: [http://localhost:8000](http://localhost:8000)

---

## 👤 Akun Demo

| Role     | Email              | Password   |
|----------|--------------------|------------|
| Admin    | admin@sundara.com  | admin123   |
| Customer | customer@sundara.com    | customer123   |

---

## 🛒 Modul Utama

- **Produk**: Menampilkan daftar produk batik, deskripsi, harga, kondisi (baru/second), dan kategori gender.
- **Keranjang**: Menyimpan item pilihan sebelum checkout.
- **Checkout**: Menampilkan alamat, metode pembayaran, ongkir, diskon voucher, dan total.
- **Pesanan**: Riwayat transaksi dan pelacakan status (Dikemas → Dikirim → Sampai).
- **Voucher**: Dukungan kode voucher diskon berdasarkan minimum pembelian.
- **Alamat Pengiriman**: Dapat diatur oleh customer.
- **Pengiriman**: Tersedia estimasi biaya berdasarkan kota & provinsi (seperti Jakarta, Bandung, Surabaya).

---

## 🔐 Role & Akses

| Role     | Hak Akses                                                                 |
|----------|---------------------------------------------------------------------------|
| Admin    | Kelola produk, voucher, pesanan dan pengguna                              |
| Customer | Lihat produk, beli barang, update alamat, lihat riwayat & tracking order  |

---

## 📝 Catatan Teknis

- Gambar produk disimpan di: `public/image/product/`
- Pastikan permission folder `storage/` dan `bootstrap/cache/` = writable
```bash
php artisan storage:link
```
- Biaya pengiriman tersimpan di tabel `shipping_costs` berdasarkan kota/provinsi
- Tracking pesanan tersimpan di `order_trackings` (status: Dikemas, Dikirim, Sampai)

---

## 📦 Ekstensi / Rencana Tambahan

- Integrasi API pengiriman (RajaOngkir / SiCepat)
- Integrasi pembayaran (Midtrans / Xendit)
- Notifikasi Email / WhatsApp
- Export laporan admin (CSV / PDF)

---

## 📄 Lisensi

Proyek ini dikembangkan sebagai bagian dari tugas akhir / pembelajaran dan bersifat open untuk kebutuhan edukasi.

---

## 🙏 Terima Kasih

Terima kasih telah menggunakan atau membaca dokumentasi ini. Semoga bermanfaat. Untuk saran dan kontribusi, silakan hubungi developer atau buka issue.

---


<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## About Laravel

Laravel is a web application framework with expressive, elegant syntax. We believe development must be an enjoyable and creative experience to be truly fulfilling. Laravel takes the pain out of development by easing common tasks used in many web projects, such as:

- [Simple, fast routing engine](https://laravel.com/docs/routing).
- [Powerful dependency injection container](https://laravel.com/docs/container).
- Multiple back-ends for [session](https://laravel.com/docs/session) and [cache](https://laravel.com/docs/cache) storage.
- Expressive, intuitive [database ORM](https://laravel.com/docs/eloquent).
- Database agnostic [schema migrations](https://laravel.com/docs/migrations).
- [Robust background job processing](https://laravel.com/docs/queues).
- [Real-time event broadcasting](https://laravel.com/docs/broadcasting).

Laravel is accessible, powerful, and provides tools required for large, robust applications.

## Learning Laravel

Laravel has the most extensive and thorough [documentation](https://laravel.com/docs) and video tutorial library of all modern web application frameworks, making it a breeze to get started with the framework.

You may also try the [Laravel Bootcamp](https://bootcamp.laravel.com), where you will be guided through building a modern Laravel application from scratch.

If you don't feel like reading, [Laracasts](https://laracasts.com) can help. Laracasts contains thousands of video tutorials on a range of topics including Laravel, modern PHP, unit testing, and JavaScript. Boost your skills by digging into our comprehensive video library.

## Laravel Sponsors

We would like to extend our thanks to the following sponsors for funding Laravel development. If you are interested in becoming a sponsor, please visit the [Laravel Partners program](https://partners.laravel.com).

### Premium Partners

- **[Vehikl](https://vehikl.com)**
- **[Tighten Co.](https://tighten.co)**
- **[Kirschbaum Development Group](https://kirschbaumdevelopment.com)**
- **[64 Robots](https://64robots.com)**
- **[Curotec](https://www.curotec.com/services/technologies/laravel)**
- **[DevSquad](https://devsquad.com/hire-laravel-developers)**
- **[Redberry](https://redberry.international/laravel-development)**
- **[Active Logic](https://activelogic.com)**

## Contributing

Thank you for considering contributing to the Laravel framework! The contribution guide can be found in the [Laravel documentation](https://laravel.com/docs/contributions).

## Code of Conduct

In order to ensure that the Laravel community is welcoming to all, please review and abide by the [Code of Conduct](https://laravel.com/docs/contributions#code-of-conduct).

## Security Vulnerabilities

If you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell via [taylor@laravel.com](mailto:taylor@laravel.com). All security vulnerabilities will be promptly addressed.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
