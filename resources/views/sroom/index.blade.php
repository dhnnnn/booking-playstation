<!DOCTYPE html>
<html lang="en">
<head>
  @include('sroom.css')
</head>
<body>

    <!-- =======Header area start======== -->
    <header class="header_area">
        @include('sroom.header')
	  </header>
    <!-- =======Header area end======== -->

    <!-- =======Main area start======== -->
    <main class="site-main">
      <!-- ================ start detail room area ================= -->
       <section class="navbar-breadcrumb">
        <nav style="--bs-breadcrumb-divider: '/';" class="navbar" aria-label="breadcrumb" style="color: #ffffff">
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a style="color: #ffffff;" href="{{url('/')}}">Home</a></li>
            <li class="breadcrumb-item"><a style="color: #ffffff;" href="{{url('/room')}}">Room</a></li>
            <li class="breadcrumb-item active" aria-current="page" style="color: #ffffff;">Detail room</li>
          </ol>
        </nav>
       </section>
      
      <section>
          <div class = "card-wrapper">
            <div class = "card ">
              <!-- card left -->
              <div class = "product-imgs">
                <div class = "img-display">
                  <div class = "img-showcase">
                    @foreach($room->images as $image)
                      <img src = "{{asset('images/rooms/'.$image->image)}}" alt = "room image">
                    @endforeach
                  </div>
                </div>
                <div class = "img-select">
                  @foreach($room->images as $index => $image)
                    <div class = "img-item">
                      <a href = "#" data-id = "{{ $index + 1 }}">
                        <img src = "{{ asset('images/rooms/' . $image->image) }}" alt = "Room image thumbnail">
                      </a>
                    </div>
                  @endforeach
                </div>
              </div>


              <!-- card right -->
                <div class = "product-content">
                  <h2 class = "product-title">{{$room->room_title}}</h2>
                  <p>Room ternyaman untuk pengalaman gaming tanpa batas</p>

                  <div class = "product-price">
                    <p class = "new-price">Rp. {{number_format($room->price, 0, ',','.')}}/jam</p>
                  </div>

                  <div class = "product-detail">
                    <h3>Tentang Ruangan ini: </h3>
                    <p>{{$room->description}}</p>
                    <p>Fasilitas :  </p>
                    <ul>
                      @foreach($room->fasilitas as $fasilitas)
                        <li>{{$fasilitas->nama_fasilitas}}</li>
                      @endforeach
                    </ul>
                  </div>

                  <div class = "purchase-info">  
                    <a href="{{ url('/room/booking/' . $room->id) }}" class="btn-gaming">Book Now</a>
                  </div>
                </div>
          </div>
        </section>
        <!-- ================ end detail room area ================= -->

        <!-- ================ start footer Area ================= -->
        @include('home.footer')
        <!-- ================ End footer Area ================= -->

    </main>
    <!-- =======Main area end======== -->
    @include('sroom.script')

</body>
</html>