# MD Gaming – Playstation Online Booking System

MD Gaming adalah sistem booking online yang mempermudah pelanggan untuk melakukan pemesanan Unit gaming secara cepat dan real-time. Sistem ini menggantikan proses booking manual, sehingga lebih efisien, transparan, dan mudah digunakan baik oleh admin maupun pelanggan.

## 🚀 Fitur Utama

1. Booking Real-Time
   - Pengguna dapat memilih tanggal, jam, durasi, dan unit yang tersedia.
   - Status unit otomatis berubah menjadi Tersedia / Tidak Tersedia sesuai booking yang dibuat.

2. Manajemen Unit
   - Setiap unit memiliki status yang akan diperbarui secara otomatis.
   - Admin bisa menambah, mengedit, atau menghapus data unit.

3. Tampilan UI Modern
   - Desain clean, gelap, dan modern.
   - Menggunakan kombinasi HTML, CSS, dan JavaScript.
   - Komponen responsif untuk mobile dan desktop.

4. Sistem Validasi
   - Validasi input saat form booking di-submit.
   - Mencegah double booking pada jam dan tanggal yang sama.

## 🛠️ Teknologi yang Digunakan

- Laravel — Backend & Routing

- Blade Template — View system

- MySQL — Database untuk booking dan status unit

- CSS Custom — UI theme dark modern

- JavaScript — Interaksi (durasi, waktu, status)

## 📘 Cara Menggunakan
1. Clone Repository
```bash
git clone https://github.com/dhnnnn/booking-playstation.git
cd booking-playstation
```
2. Install Dependencies
```bash
composer install
npm install
```
3. Setup Environment

```bash
cp .env.example .env
php artisan key:generate
```
Sesuaikan database pada .env:

```makefile
DB_DATABASE=booking_db
DB_USERNAME=root
DB_PASSWORD=
```

4. Migrate Database
```bash
php artisan migrate
```

5. Jalankan Server
```bash
php artisan serve
```
## 🧪 Cara Kerja Booking

User memilih tanggal dan jam.

1. Sistem mengecek apakah unit tersebut sudah dibooking atau masih tersedia.

2. Jika tersedia → sistem menyimpan booking dan status unit berubah menjadi Tidak Tersedia di jam tersebut.

3. Jika tidak tersedia → user akan mendapat pesan bahwa unit sedang dipakai.
