<p align="center">
  <img width="100%" src="public\images\readme\tumbnail.png" align="center" />
  <h2 align="center" >MD Gaming – Playstation Online Booking System</h2>
</p>


<p align="center">
  <a href="https://github.com/dhnnnn/Forest-Defender/graphs/contributors">
      <img alt="GitHub Contributors" src="https://img.shields.io/github/contributors/dhnnnn/booking-playstation?style=flat" />
    </a>
  
  <a href="https://github.com/dhnnnn/Forest-Defender/watchers">
  <img alt="GitHub watchers" src="https://img.shields.io/github/watchers/dhnnnn/booking-playstation?style=flat&color=800080" />
</a>

  <a href="https://github.com/dhnnnn/Forest-Defender/pulls">
      <img alt="GitHub pull requests" src="https://img.shields.io/github/issues-pr/dhnnnn/booking-playstation?color=0088ff" />
    </a>
<br/>
<a href="https://github.com/dhnnnn/Forest-Defender/network/members">
  <img alt="GitHub forks" src="https://img.shields.io/github/forks/dhnnnn/booking-playstation?style=flat&color=4caf50"/>
</a>

<a href="https://github.com/dhnnnn/Forest-Defender/stargazers">
  <img alt="GitHub stars" src="https://img.shields.io/github/stars/dhnnnn/booking-playstation?style=flat&color=ffc107" />
</a>
</p>

MD Gaming adalah sistem booking online yang mempermudah pelanggan untuk melakukan pemesanan Unit gaming secara cepat dan real-time. Sistem ini menggantikan proses booking manual, sehingga lebih efisien, transparan, dan mudah digunakan baik oleh admin maupun pelanggan.

## 🚀 Fitur Utama

1. Booking Real-Time
    - Pengguna dapat memilih tanggal, jam, durasi, dan unit yang tersedia.
    - Sistem secara otomatis menampilkan ketersediaan unit secara real-time.
    - Status unit akan berubah sesuai dengan jadwal booking yang dibuat.

2. Pembayaran Online (Midtrans)

    - Sistem terintegrasi dengan Midtrans Payment Gateway.
    - Mendukung berbagai metode pembayaran (Transfer Bank, E-Wallet, dll).
    - Status booking akan otomatis tervalidasi setelah pembayaran berhasil.
    - Callback Midtrans digunakan untuk memastikan status transaksi secara aman.

3. Invoice Otomatis via WhatsApp

    - Setelah pembayaran berhasil dan tervalidasi, sistem akan:
    - Meng-generate invoice booking
    - Mengirimkan invoice secara otomatis ke WhatsApp pengguna
    - Integrasi menggunakan Fonte WhatsApp Gateway (fonte.id).

4. Manajemen Unit

    - Setiap unit memiliki status dinamis berdasarkan jadwal booking.
    - Admin dapat menambah, mengedit, dan menghapus data unit.
    - Status unit akan diperbarui otomatis setelah pembayaran berhasil.

5. Sistem Validasi Booking

    - Validasi input pada form booking.
    - Mencegah double booking pada unit, tanggal, dan jam yang sama.
    - Booking hanya dikonfirmasi setelah pembayaran berhasil.

6. Tampilan UI Modern

    - Desain clean, gelap, dan modern.
    - Menggunakan HTML, CSS, dan JavaScript.
    - Komponen responsif untuk mobile dan desktop.

## 🛠️ Teknologi yang Digunakan

- Laravel — Backend & Routing

- Blade Template — View system

- MySQL — Database untuk booking dan status unit
  
- Midtrans — Payment Gateway

- Fonte WhatsApp Gateway — Pengiriman invoice otomatis via WhatsApp

- CSS Custom — UI theme dark modern

- JavaScript — Interaksi (durasi, waktu, status)

## 📘 Cara Menggunakan
1. Prasyarat
> Aplikasi ini **wajib dijalankan** menggunakan Docker untuk memastikan environment konsisten (PHP, MySQL, Node, dan service pendukung).
- Docker
- Docker Compose
- Git

2. Clone Repository
```
git clone https://github.com/dhnnnn/booking-playstation.git
cd booking-playstation
```

3. Konfigurasi Environment
```
cp .env.example .env
```

Atur database agar sesuai dengan service Docker:
```
DB_CONNECTION=mysql
DB_HOST=db
DB_PORT=3306
DB_DATABASE=booking_db
DB_USERNAME=root
DB_PASSWORD=root
```

Tambahkan konfigurasi Midtrans dan Fonte:
```
MIDTRANS_SERVER_KEY=your_midtrans_server_key
MIDTRANS_CLIENT_KEY=your_midtrans_client_key
MIDTRANS_IS_PRODUCTION=false

FONTE_API_KEY=your_fonte_api_key
FONTE_DEVICE=your_device_name
FONTE_BASE_URL=https://api.fonte.id
```

4. Jalankan Docker Container
```
docker compose up -d --build
```
Pastikan container berjalan:
```
docker ps
```
5. Akses Aplikasi
```
http://localhost:8000
```

## 🧪 Cara Kerja Booking

1. User melakukan booking melalui aplikasi Laravel di container.
2. Sistem memvalidasi ketersediaan unit dari database MySQL (container).
3. User diarahkan ke pembayaran Midtrans.
4. Midtrans mengirim callback ke endpoint Laravel.
5. Setelah pembayaran berhasil:
    - Status booking dikonfirmasi
    - Invoice dibuat otomatis
    - Invoice dikirim ke WhatsApp via Fonte Gateway
