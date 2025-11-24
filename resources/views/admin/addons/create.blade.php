<!DOCTYPE html>
<html lang="en">
<head>
    @include('admin.css')
</head>
<body>
    <div class="container">
        <header>
            @include('admin.addons.header')
        </header>


        <main>
            <section class="widget recent-bookings">
                    <h3 class="widget-title">TAMBAH Barang</h3>
                    <form class="add-room-form" action="{{url('add_addons')}}" method="Post" enctype="multipart/form-data">

                        @csrf

                        <label for="nama-barang">Nama Barang:</label>
                        <input type="text" id="nama-barang" name="nama-barang" required>

                        <label for="deskripsi-barang">Deskripsi Barang:</label>
                        <textarea id="deskripsi-barang" name="deskripsi-barang" required></textarea>

                        <label for="harga">Harga:</label>
                        <input type="number" id="harga" name="harga" required>

                        <label for="stock">Stok:</label>
                        <input type="number" id="stock" name="stock" required>

                        <label for="photo">Foto Barang :</label>
                        <input type="file" id="photo" name="photo[]" multiple required>


                        <button type="submit" class="submit-btn">Tambah Barang</button>
                    </form>
            </section>
        </main>
    </div>


    @include('admin.script')
</body>
</html>