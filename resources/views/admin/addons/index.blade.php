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
                    <div class="">
                        <h3 class="widget-title">Barang</h3>
                        <a href="{{url('/addons/create')}}"><button>Tambah</button></a>
                    </div>
                    <table>
                        <thead>
                            <tr>
                                <th>Add Ons ID</th>
                                <th>Gambar</th>
                                <th>Nama Barang</th>
                                <th>Deskripsi</th>
                                <th>Harga</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>

                            @foreach($addons as $addon => $addons)
                            <tr>
                                <td>{{$addons->id}}</td>
                                <td>
                                    <img width="80" src="{{ asset('images/addons/' . $addons->image) }}" alt="">
                                </td>
                                <td>{{$addons->addons_title}}</td>
                                <td>{{$addons->description}}</td>
                                <td>Rp. {{number_format($addons->price, 0, ',','.')}}</td>
                                <td>
                                    <a href="{{url('addons/update', $addons->id)}}"><button class="edit-btn"><i class="fa-solid fa-pen-to-square"></i> Edit</button></a>
                                    <a href="{{url('addons/delete', $addons->id)}}"><button class="delete-btn"><i class="fa-solid fa-trash"></i> Delete</button></a>
                                </td>
                            </tr>
                            @endforeach

                        </tbody>
                    </table>
                </section>
        </main>
    </div>
    
    <x-notify::notify />
    @notifyJs

</body>
</html>