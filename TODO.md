# TODO: Perbaikan Database dan Model untuk Room, Image, dan Fasilitas

## Tugas Utama

-   [x] Perbaiki migration fasilitas_room untuk menambahkan foreign key constraints
-   [x] Perbaiki ImageFactory untuk menghapus room_id yang tidak perlu
-   [x] Update DatabaseSeeder untuk menghubungkan fasilitas ke rooms
- [x] Jalankan migration dan seeder untuk testing

## Langkah-langkah

1. Edit migration fasilitas_room
2. Edit ImageFactory
3. Edit DatabaseSeeder
4. Jalankan php artisan migrate:fresh --seed
5. Verifikasi data di database
