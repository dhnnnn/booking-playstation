<!DOCTYPE html>
<html lang="en">
<head>
    @include('home.css')
</head>
<body>
    <!-- =======Header area start======== -->
    <header class="header_area">
        @include('home.header')
	</header>
    <!-- =======Header area end======== -->

    <!-- =======Main area start======== -->
    <main class="site-main">
        <!-- ================ start banner area ================= --> 
            @include('home.banner')
        <!-- ================ end banner area ================= -->
        
        <!-- ================ about section start ================= --> 
            @include('home.about')
        <!-- ================ about section end ================= --> 

        <!-- ================ room section start ================= -->
            @include('home.room')
        <!-- ================ room section end ================= --> 

        <!-- ================ fasilitas section start ================= -->
            @include('home.fasilitas')
        <!-- ================ fasilitas section end ================= -->

        <!-- ================ testimonial section start ================= -->
            @include('home.testimonial')
        <!-- ================ testimonial section end ================= -->

        <!-- ================ start footer Area ================= -->
            @include('home.footer')
        <!-- ================ End footer Area ================= -->

    </main>
    <!-- =======Main area end======== -->

    <!-- Optional JavaScript -->
    @include('home.script')
</body>
</html>