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
                    <h3 class="widget-title">Update Barang</h3>
                    <form class="add-room-form" action="{{url('edit_addons', $addons->id)}}" method="Post" enctype="multipart/form-data">

                        @csrf

                        <label for="nama-barang">Nama Barang:</label>
                        <input type="text" id="nama-barang" name="nama-barang" value="{{$addons->addons_title}}" required>

                        <label for="deskripsi-barang">Deskripsi Barang:</label>
                        <textarea id="deskripsi-barang" name="deskripsi-barang" required>{{$addons->description}}</textarea>

                        <label for="harga">Harga:</label>
                        <input type="number" id="harga" name="harga" value="{{$addons->price}}" required>

                        <label for="stock">Stok:</label>
                        <input type="number" id="stock" name="stock" value="{{$addons->stock}}" required>
                        
                        <label for="photo">Foto Barang :</label>
                        <input type="file" id="photo" name="photo[]" multiple>


                        <button type="submit" class="submit-btn">Update Barang</button>
                    </form>
            </section>
        </main>
    </div>


    @include('admin.script')
</body>
</html>