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
                    <h3 class="widget-title">Update Room</h3>
                    <form class="add-room-form" action="{{url('edit_room', $data->id)}}" method="Post" enctype="multipart/form-data">
                        @csrf

                            <label for="room-name">Nama Room:</label>
                            <input type="text" id="room-name" name="room-name" value="{{$data->room_title}}" required>

                            <label for="room-description">Deskripsi Room:</label>
                            <textarea id="room-description" name="room-description" value="{{$data->description}}" required>{{$data->description}}</textarea>

                            <label for="room-type">Type Room:</label>
                            <select id="room-type" name="room-type" required>
                                <option value="{{$data->room_type}}">{{$data->room_type}}</option>
                                <option value="regular">Regular</option>
                                <option value="vip">VIP</option>
                                <option value="vvip">VVIP</option>
                            </select>

                            <label for="price">Harga:</label>
                            <input type="number" id="price" name="price" value="{{$data->price}}" required>

                            <label for="total_units">Total room:</label>
                            <input type="number" id="total_units" name="total_units" value="{{$data->total_units}}" required>


                            <div class="multi-select-container">
                                <label for="fasilitas"><strong>Fasilitas</strong></label>
                                    <div class="selected-tags" id="selected-tags">
                                        @if($data->fasilitas->isNotEmpty())
                                            @foreach($data->fasilitas as $f)
                                                <span class="tag" data-id="{{ $f->id }}">{{ $f->nama_fasilitas }}</span>
                                            @endforeach
                                        @else
                                            Pilih fasilitas...
                                        @endif
                                    </div>
                                    <div class="dropdown" id="dropdown">
                                        @foreach($fasilitasList as $fasilitas)
                                            <div 
                                                class="dropdown-item {{ $data->fasilitas->contains('id', $fasilitas->id) ? 'selected' : '' }}" 
                                                data-value="{{ $fasilitas->id }}">
                                                {{ $fasilitas->nama_fasilitas }}
                                            </div>
                                        @endforeach
                                    </div>
                            </div>
                            <input type="hidden" name="fasilitas" id="fasilitas-input">

                            <label for="photo">Foto Room 1:</label>
                            <input type="file" id="photo" name="photo[]" multiple>

                            <label for="photo">Foto Room 2:</label>
                            <input type="file" id="photo" name="photo[]" multiple>

                            <label for="photo">Foto Room 3:</label>
                            <input type="file" id="photo" name="photo[]" multiple>

                            <label for="photo">Foto Room 4:</label>
                            <input type="file" id="photo" name="photo[]" multiple>

                            <button type="submit" class="submit-btn">Update Room</button>
                    </form>
            </section>
        </main>
    </div>


    @include('admin.script')
</body>
</html>