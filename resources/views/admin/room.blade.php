<!DOCTYPE html>
<html lang="en">
<head>
    @include('admin.css')
</head>
<body>
    <div class="container">
        <header>
            <div class="logo">
                <img src="../img/Logo.png" alt="MD Gaming Logo">
            </div>
            <nav>
                <ul>
                    <li><a href="{{url('/home')}}">Dashboard</a></li>
                    <li><a href="#">Booking</a></li>
                    <li><a href="#" class="active">Rooms</a></li>
                    <li><a href="#">Users</a></li>
                    <li><a href="#">Reports</a></li>
                </ul>
            </nav>
            <div class="user-actions">
                <i class="fa-solid fa-user"></i>
                <i class="fa-solid fa-bell"></i>
                <i class="fa-solid fa-cog"></i>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                        <button type="submit" class="logout-btn">Log Out</button>
                </form>
            </div>
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
                                <th>Nama ROOM</th>
                                <th>Type Room</th>
                                <th>Harga</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>

                            @foreach($data as $rooms => $data)
                            <tr>
                                <td>{{$data->id}}</td>
                                <td>
                                    @if ($data->images->isNotEmpty())
                                        <img width="80" src="{{ asset('images/' . $data->images->first()->image) }}" alt="">
                                    @else
                                        <img width="80" src="{{ asset('images/default.png') }}" alt="default">
                                    @endif
                                </td>
                                <td>{{$data->room_title}}</td>
                                <td>{{$data->room_type}}</td>
                                <td>Rp. {{$data->price}}</td>
                                <td>
                                    <a href="{{url('update', $data->id)}}"><button class="edit-btn"><i class="fa-solid fa-pen-to-square"></i> Edit</button></a>
                                    <a href="{{url('delete', $data->id)}}"><button class="delete-btn"><i class="fa-solid fa-trash"></i> Delete</button></a>
                                </td>
                            </tr>
                            @endforeach

                        </tbody>
                    </table>
                </section>
        </main>
    </div>
    <script>
        document.querySelectorAll('.toggle-wrapper input[type="checkbox"]').forEach(toggle => {
            toggle.addEventListener('change', function () {
                const textElement = this.closest('.toggle-wrapper').querySelector('.toggle-text');
                if (this.checked) {
                    textElement.textContent = 'Available';
                    textElement.style.color = 'green';
                } else {
                    textElement.textContent = 'Occupied';
                    textElement.style.color = 'red';
                }
            });
        });
    </script>
</body>
</html>