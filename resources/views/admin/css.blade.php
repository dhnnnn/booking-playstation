<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel - MD Gaming Playstation</title>
    <link rel="icon" href="public/img/favicon.png" type="image/png">
    <link rel="stylesheet" href="admin/style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
<style>
    /* CSS Variables untuk Palet Warna */
:root {
    --bg-dark: #1A1A2E;
    --bg-widget: #23233D;
    --primary-yellow: #F7B731;
    --accent-purple: #8A4FFF;
    --accent-dark-purple: #6A11CB;
    --text-light: #EAEAEA;
    --text-dark: #7c7a7a;
    --status-green: #1DD1A1;
    --status-red: #FF6B6B;
    --border-color: #3b3b61;
}

/* Reset dan Pengaturan Dasar */
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
    font-family: 'Poppins', sans-serif;
}

body {
    background-color: var(--bg-dark);
    color: var(--text-light);
    display: flex;
    justify-content: center;
    padding: 20px;
}

.container {
    width: 100%;
    max-width: 1600px;
}

/* Header & Navbar */
header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 15px 30px;
    background-color: var(--bg-widget);
    border-radius: 12px;
    margin-bottom: 25px;
    flex-wrap: wrap; /* DITAMBAHKAN: Agar header bisa wrap di layar kecil */
    gap: 15px; /* DITAMBAHKAN: Memberi jarak jika item header turun baris */
}

header .logo {
    display: flex;
    align-items: center;
}

header .logo img {
    height: 40px;
    margin-right: 15px;
}

header .logo h1 {
    font-size: 1.2rem;
    font-weight: 600;
}

header nav ul {
    list-style: none;
    display: flex;
    gap: 30px;
}

header nav a {
    text-decoration: none;
    color: var(--text-dark);
    font-weight: 500;
    transition: color 0.3s ease;
}

header nav a.active,
header nav a:hover {
    color: var(--primary-yellow);
}

.user-actions {
    display: flex;
    align-items: center;
    gap: 20px;
}

.user-actions i {
    font-size: 1.2rem;
    color: var(--text-dark);
    cursor: pointer;
    transition: color 0.3s ease;
}

.user-actions i:hover {
    color: var(--text-light);
}

.logout-btn {
    background-color: var(--accent-purple);
    color: white;
    border: none;
    padding: 10px 20px;
    border-radius: 8px;
    cursor: pointer;
    font-weight: 600;
    transition: background-color 0.3s ease;
}

.logout-btn:hover {
    background-color: var(--accent-dark-purple);
}

/* Main Content */
main .dashboard-header {
    margin-bottom: 20px;
}

main .dashboard-header h2 {
    font-size: 2rem;
    font-weight: 700;
    color: var(--text-light);
}

/* Stats Grid */
.stats-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
    gap: 20px;
    margin-bottom: 25px;
}

.card {
    display: flex;
    align-items: center;
    gap: 20px;
    padding: 25px;
    border-radius: 12px;
}

.card i {
    font-size: 2.5rem;
}

.card-content p {
    font-size: 0.9rem;
    color: var(--text-light);
}

.card-content h3 {
    font-size: 1rem;
    font-weight: 700;
}

.card-yellow { background-color: var(--primary-yellow); color: var(--bg-dark); }
.card-light { background-color: var(--text-light); color: var(--bg-dark); }
.card-purple { background-color: var(--accent-purple); color: var(--text-light); }
.card-dark-purple { background-color: var(--accent-dark-purple); color: var(--text-light); }

/* Main Content Grid */
.main-content-grid {
    display: grid;
    grid-template-columns: minmax(0, 2fr) minmax(0, 1fr); /* DIPERBAIKI: Mencegah overflow */
    gap: 25px;
    align-items: flex-start;
}

.widget {
    background-color: var(--bg-widget);
    padding: 25px;
    border-radius: 12px;
    overflow: hidden; /* DITAMBAHKAN: Mencegah konten keluar dari widget */
}

.widget-title {
    margin-bottom: 20px;
    font-size: 1.2rem;
    font-weight: 600;
    border-left: 4px solid var(--primary-yellow);
    padding-left: 10px;
}

/* Recent Bookings Table */
.recent-bookings {
    overflow-x: auto; /* DIPERBAIKI: Membuat tabel bisa di-scroll horizontal jika terlalu lebar */
}

.recent-bookings table {
    width: 100%;
    border-collapse: collapse;
    min-width: 600px; /* DITAMBAHKAN: Menetapkan lebar minimum agar tidak terlalu sempit */
}

.recent-bookings th, .recent-bookings td {
    text-align: left;
    padding: 15px 10px;
    border-bottom: 1px solid var(--border-color);
    white-space: nowrap; /* DITAMBAHKAN: Mencegah teks turun baris */
}

.recent-bookings thead th {
    color: var(--text-dark);
    font-weight: 500;
}

.status {
    padding: 5px 12px;
    border-radius: 20px;
    font-size: 0.8rem;
    font-weight: 600;
    color: #fff;
}

.status.completed { background-color: var(--status-green); }
.status.active { background-color: var(--primary-yellow); color: var(--bg-dark); }
.status.pending { background-color: var(--status-red); }

.view-all-btn {
    width: 100%;
    margin-top: 20px;
    padding: 12px;
    background-color: var(--bg-dark);
    border: 1px solid var(--border-color);
    color: var(--text-light);
    border-radius: 8px;
    cursor: pointer;
    font-weight: 600;
    transition: background-color 0.3s;
}
.view-all-btn:hover {
    background-color: #333356;
}

/* Room Availability */
.room-grid {
    display: grid;
    /* DIPERBAIKI: Menggunakan auto-fit untuk responsivitas otomatis */
    grid-template-columns: repeat(auto-fit, minmax(100px, 1fr));
    gap: 15px;
}

.room-item {
    padding: 20px 10px;
    border-radius: 8px;
    text-align: center;
    font-weight: 600;
    border: 2px solid transparent;
}

.room-item.available {
    background-color: rgba(29, 209, 161, 0.1);
    border-color: var(--status-green);
    color: var(--status-green);
}

.room-item.used {
    background-color: rgba(255, 107, 107, 0.1);
    border-color: var(--status-red);
    color: var(--status-red);
}

.room-item.vip {
    background-color: rgba(138, 79, 255, 0.2);
    border-color: var(--accent-purple);
    color: var(--accent-purple);
}

/* Actions Widget */
.actions-widget {
    display: flex;
    flex-direction: column;
    gap: 20px;
}

.action-buttons {
    display: flex;
    flex-direction: column;
    gap: 15px;
}

.action-btn {
    background-color: var(--primary-yellow);
    border: none;
    color: var(--bg-dark);
    padding: 15px;
    border-radius: 8px;
    font-weight: 700;
    font-size: 1rem;
    cursor: pointer;
    transition: transform 0.2s;
}

.action-btn:hover {
    transform: translateY(-2px);
}

.image-placeholder {
    position: relative;
    border-radius: 8px;
    overflow: hidden;
    height: 100%;
    min-height: 200px;
}

.image-placeholder img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}

.image-placeholder .overlay {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: linear-gradient(to top, rgba(0,0,0,0.8), transparent);
    display: flex;
    align-items: flex-end;
    padding: 20px;
}

.image-placeholder .overlay h4 {
    color: white;
    font-size: 1.5rem;
    font-weight: 700;
}

.widget-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 20px;
}

/* Style umum untuk tombol */
button {
  font-family: 'Poppins', sans-serif;
  font-size: 14px;
  font-weight: 500;
  border: none;
  border-radius: 8px;
  padding: 8px 14px;
  cursor: pointer;
  transition: all 0.25s ease-in-out;
  display: inline-flex;
  align-items: center;
  gap: 6px;
}

/* Tombol tambah */

button {
  background-color: #28a745;
  color: #fff;
  margin-bottom: 15px;
}

button:hover {
  background: #218838;
  transform: translateY(-2px);
}

/* Tombol edit */
.edit-btn {
  background-color: #007bff;
  color: #fff;
  margin-right: 12px;
}

.edit-btn:hover {
  background-color: #0069d9;
  transform: translateY(-2px);
}

/* Tombol delete */
.delete-btn {
  background-color: #dc3545;
  color: #fff;
}

.delete-btn:hover {
  background-color: #c82333;
  transform: translateY(-2px);
}

/* Icon di dalam tombol */
button i {
  font-size: 14px;
}

.add-room-form{
    display: flex;
    flex-direction: column;
    gap: 15px;
}

.add-room-form { /* warna container form */
  padding: 30px;
  border-radius: 12px;
  color: #fff;
  font-family: 'Poppins', sans-serif;
  width: 100%;
}

.add-room-form label {
  display: block;
  font-weight: 600;
  margin-bottom: 6px;
  margin-top: 10px;
  color: #ffffff;
}

.add-room-form input,
.add-room-form select {
  width: 100%;
  padding: 10px 14px;
  margin-bottom: 20px;
  border: none;
  border-radius: 6px;
  font-size: 15px;
  background-color: #1A1A2E;
  color: #ffffff;
  outline: none;
  transition: all 0.3s ease;
}

.add-room-form input:focus,
.add-room-form select:focus {
  box-shadow: 0 0 8px rgba(0, 128, 255, 0.6);
}

.add-room-form button {
  width: 135px;
  align-self: flex-start;
}

.toggle-wrapper {
  display: flex;
  align-items: center;
  gap: 10px;
}

/* Tampilan dasar toggle */
.toggle {
  position: relative;
  width: 55px;
  height: 28px;
  background-color: #555;
  border-radius: 30px;
  cursor: pointer;
  transition: background-color 0.3s ease;
}

/* Bola di dalam toggle */
.toggle-ball {
  position: absolute;
  top: 3px;
  left: 3px;
  width: 22px;
  height: 22px;
  background-color: white;
  border-radius: 50%;
  transition: transform 0.3s ease;
}

/* Sembunyikan checkbox asli */
.toggle-wrapper input[type="checkbox"] {
  display: none;
}

/* Ketika checkbox aktif (ON) */
.toggle-wrapper input[type="checkbox"]:checked + .toggle {
  background-color: #00b84f; /* warna hijau aktif */
}

.toggle-wrapper input[type="checkbox"]:checked + .toggle .toggle-ball {
  transform: translateX(27px);
}

/* Label teks di samping */
.toggle-text {
  font-weight: 600;
  color: #fff;
}

  .multi-select-container {
    width: 100%;
    position: relative;
    font-family: "Poppins", sans-serif;
  }

  .selected-tags {
    display: flex;
    flex-wrap: wrap;
    gap: 6px;
    border: 1px solid #2b2e4a;
    padding: 8px 10px;
    background: #2a2d4a;
    border-radius: 10px;
    cursor: pointer;
    transition: border-color 0.2s;
    color: #aaa;
  }

  .selected-tags:hover {
    border-color: #5865f2;
  }

  /* tag hasil pilihan */
  .selected-tags .tag {
    background: #3c3f66;
    border-radius: 8px;
    padding: 5px 10px;
    display: flex;
    align-items: center;
    gap: 6px;
    font-size: 13px;
    color: #fff;
    font-weight: 500;
    line-height: 1;
    animation: fadeIn 0.2s ease-in-out;
  }

  /* tombol penghapus di dalam tag */
  .selected-tags .tag .remove-tag {
    border: none;
    background: none;
    cursor: pointer;
    font-weight: bold;
    margin-left: 6px;
    color: #aaa;
    font-size: 14px;
    transition: color 0.2s;
    line-height: 1;
    padding: 0;
    height: auto;
    width: auto;
    align-self: center;
  }

  .selected-tags .tag .remove-tag:hover {
    color: #ff6b6b;
  }

  /* dropdown list */
  .dropdown {
    position: absolute;
    width: 100%;
    background: #2a2d4a;
    border: 1px solid #2b2e4a;
    border-radius: 10px;
    margin-top: 6px;
    max-height: 200px;
    overflow-y: auto;
    display: none;
    z-index: 10;
    box-shadow: 0 8px 15px rgba(0, 0, 0, 0.3);
  }

  .dropdown.active {
    display: block;
  }

  .dropdown-item {
    padding: 10px 14px;
    cursor: pointer;
    color: #dcdcdc;
    transition: background 0.2s, color 0.2s;
  }

  .dropdown-item:hover {
    background: #393c5f;
    color: #fff;
  }

  .dropdown-item.selected {
    background: #5865f2;
    color: #fff;
    font-weight: 500;
  }

  @keyframes fadeIn {
    from {
      opacity: 0;
      transform: scale(0.9);
    }
    to {
      opacity: 1;
      transform: scale(1);
    }
  }


    /* Scrollbar style */
    .dropdown::-webkit-scrollbar {
      width: 6px;
    }

    .dropdown::-webkit-scrollbar-thumb {
      background: #444;
      border-radius: 3px;
    }

    .dropdown::-webkit-scrollbar-thumb:hover {
      background: #666;
    }

    .add-room-form textarea {
        width: 100%;
        padding: 10px 14px;
        margin-bottom: 20px;
        border: none;
        border-radius: 6px;
        font-size: 15px;
        background-color: #1A1A2E;
        color: #ffffff;
        outline: none;
        resize: none; /* opsional: agar tidak bisa diubah ukurannya */
        transition: all 0.3s ease;
        font-family: 'Poppins', sans-serif;
    }

    .add-room-form textarea:focus {
        box-shadow: 0 0 8px rgba(0, 128, 255, 0.6);
    }


/* Responsif */
@media (max-width: 768px) {
  button {
    font-size: 13px;
    padding: 6px 10px;
  }

  button i {
    font-size: 12px;
  }
}


/* Responsiveness */
@media (max-width: 1200px) {
    .main-content-grid {
        grid-template-columns: 1fr; /* Stack menjadi 1 kolom */
    }
}

@media (max-width: 768px) {
    body {
        padding: 10px;
    }
    header {
        justify-content: center; /* Pusatkan item header di layar kecil */
    }
    header nav {
        display: none; /* Sembunyikan nav di layar lebih kecil */
    }
}

/* Tidak perlu media query tambahan untuk stats-grid dan room-grid karena sudah menggunakan auto-fit */
</style>