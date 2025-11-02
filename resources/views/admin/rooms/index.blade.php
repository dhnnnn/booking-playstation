<!DOCTYPE html>
<html lang="en">
<head>
    @include('admin.css')
</head>
<body>
    
    <div class="container">
        <header>
            @include('admin.rooms.header')
        </header>

        <main>
            <section class="widget recent-bookings">
                    <div class="">
                        <h3 class="widget-title">GAMING ROOM</h3>
                        <a href="{{url('/rooms/create')}}"><button>Tambah</button></a>
                    </div>
                    <table>
                        <thead>
                            <tr>
                                <th>Room ID</th>
                                <th>Gambar</th>
                                <th>Nama Room</th>
                                <th>Type Room</th>
                                <th>Harga</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>

                            @foreach($data as $rooms => $data)
                            <tr>
                                <td>{{$data->id}}</td>
                                <td>
                                    @if ($data->images->isNotEmpty())
                                        <img width="80" src="{{ asset('images/rooms/' . $data->images->first()->image) }}" alt="">
                                    @else
                                        <img width="80" src="{{ asset('images/default.png') }}" alt="default">
                                    @endif
                                </td>
                                <td>{{$data->room_title}}</td>
                                <td>{{$data->room_type}}</td>
                                <td>Rp. {{number_format($data->price, 0, ',','.')}}</td>
                                <td>
                                    <a href="{{url('rooms/update', $data->id)}}"><button class="edit-btn"><i class="fa-solid fa-pen-to-square"></i> Edit</button></a>
                                    <a href="{{url('rooms/delete', $data->id)}}"><button class="delete-btn"><i class="fa-solid fa-trash"></i> Delete</button></a>
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