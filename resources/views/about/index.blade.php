<!DOCTYPE html>
<html lang="en">
<head>
    @include('home.css')
</head>
<body>
    <!-- =======Header area start======== -->
    <header class="header_area">
        @include('about.header')
</header>
    <main class="site-main">
        <!-- ================ start banner area ================= --> 
        <section class="blog-banner-area" id="about">
            <div class="container h-100">
                <div class="blog-banner">
                    <div class="text-center">
                        <h1>Tentang kami</h1>
                        <nav aria-label="breadcrumb" class="banner-breadcrumb">
                            <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Tentang kami</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
	      </section>
        
        <!-- ================ welcome section start ================= --> 
        @include('home.about')
        <!-- ================ welcome section end ================= --> 

        <!-- ================ special section start ================= -->
        @include('home.Fasilitas')
        <!-- ================ special section end ================= -->

        <!-- ================ carousel section start ================= -->
        @include('home.testimonial')
        <!-- ================ carousel section end ================= -->

        <!-- ================ start footer Area ================= -->
        @include('home.footer')
        <!-- ================ End footer Area ================= -->

    </main>
    <!-- =======Main area end======== -->

    @include('home.script')

</body>
</html>