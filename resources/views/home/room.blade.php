        
        <section class="section-margin">
          <div class="container">
            <div class="section-intro text-center pb-80px">
              <h2 class="welcome-content" data-aos="fade-down" data-aos-duration="1000">Cari ruangan kami</h2>
            </div>
            
            <div class="row section-margin--small">
              @foreach($room as $rooms)
              <div class="col-md-6 col-lg-4 mb-4 mb-lg-0" class="welcome-content" data-aos="fade-right" data-aos-duration="{{ 1000 + ($loop->iteration - 1) * 400 }}">
                <div class="card card-explore">
                  <div class="card-explore__img">
                    <img class="card-img" src="{{ asset('images/rooms/' . $rooms->images->first()->image) }}" alt="">
                  </div>
                  <div class="card-body">
                    <h3 class="card-explore__price">Rp. {{number_format($rooms->price, 0, ',','.')}} <sub>/ Jam</sub></h3>
                    <h4 class="card-explore__title"><a href="" class="text-decoration-none">{{$rooms->room_title}}</a></h4>
                    <p>{{$rooms->description}}</p>
                    <a class="card-explore__link text-decoration-none" href="{{url('/room/detail', $rooms->id)}}">Booking sekarang <i class="ti-arrow-right"></i></a>
                  </div>
                </div>
              </div>
              @endforeach
            </div>

              
        </section>