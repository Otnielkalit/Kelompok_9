@extends('layout.source')
@section('content')
<title>about</title>
<!-- ======= Header ======= -->
<header id="header" class="fixed-top">
    <div class="container d-flex align-items-center">

        <h1 class="logo me-auto"><a href="/">Little Star</a></h1>

        <nav id="navbar" class="navbar order-last order-lg-0">
            <ul>
                <li><a href="/">Beranda</a></li>
                <li><a class="active" href="/about">Tentang</a></li>
                
            </ul>
            <i class="bi bi-list mobile-nav-toggle"></i>
        </nav><!-- .navbar -->

        <a href="{{ route('login') }}" class="get-started-btn">{{Auth::check() ? 'Dashboard' : 'Masuk'}}</a>
    </div>
</header><!-- End Header -->
<main id="main">
    <!-- ======= Breadcrumbs ======= -->
    <div class="breadcrumbs" data-aos="fade-in">
        <div class="container">
            <h2>Tentang Kami</h2>
            <p>"Membentuk anak anak yang cerdas dan berkembang sesuai dengan usianya". </p>
        </div>
    </div><!-- End Breadcrumbs -->

    <section id="about" class="about">
        <div class="container" data-aos="fade-up">

            <div class="row">
                <div class="col-lg-6 order-1 order-lg-2" data-aos="fade-left" data-aos-delay="100">
                    <img src="assets/landing/img/hero-bg.jpg" class="img-fluid" alt="">
                </div>
                <div class="col-lg-6 pt-4 pt-lg-0 order-2 order-lg-1 content">
                    <h3>KATEGORI KELAS & FASILITAS</h3>
                    <p class="fst-italic">
                    <h2>KATEGORI KELAS</h2>
                    </p>
                    <ul>
                        <li>
                            <h4><i class="bi bi-check-circle"></i>
                                Toddler(1,5- 3 years old)</h4>
                        </li>
                        <li>
                            <h4><i class="bi bi-check-circle"></i>
                                Playgroup ( 3-4 years old)</h4>
                        </li>
                        <li>
                            <h4><i class="bi bi-check-circle"></i>
                                Kindergarten ( 4-6 years old)</h4>
                        </li>
                    </ul>
                    <p class="fst-italic">
                    <h2>FASILITAS</h2>
                    </p>
                    <ul>
                        <li>
                            <h4><i class="bi bi-check-circle"></i>
                                Home setting</h4>
                        </li>
                        <li>
                            <h4><i class="bi bi-check-circle"></i>
                                Billingual Options</h4>
                        </li>
                        <li>
                            <h4><i class="bi bi-check-circle"></i>
                                Indoor & Outdoor play</h4>
                        </li>
                    </ul>

                </div>
            </div>

        </div>
    </section><!-- End About Section -->

    <!-- Modal Body -->
    <!-- if you want to close by clicking outside the modal, delete the last endpoint:data-bs-backdrop and data-bs-keyboard -->
    <div class="modal fade" id="masuk" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false" role="dialog" aria-labelledby="modalTitleId" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-sm" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalTitleId">Masuk ke Dashboard</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="mb-3">
                            <label for="username" class="form-label">Username</label>
                            <input type="text" class="form-control" id="username" name="username">
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" class="form-control" id="password" name="password">
                        </div>
                        <button type="submit" class="btn btn-primary">Masuk</button>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                </div>
            </div>
        </div>
    </div>

    <!-- ======= Footer ======= -->
    <footer id="footer">

        <div class="footer-top">
            <div class="container">
                <div class="row">

                    <div class="col-lg-3 col-md-6 footer-contact">
                        <h3>Alamat</h3>
                    <p>
                        Perumahan TASBI 1<br>
                        Blok B 58, Jl. Setia Budi<br>
                        Tanjung Rejo, Medan <br><br>
                        <strong>Phone:</strong> +62 813-7088-4942<br>
                        <strong>Email:</strong> littlestarmedan@gmail.com<br>
                    </p>
                    </div>
                </div>
            </div>
        </div>

        <div class="container d-md-flex py-4">

            <div class="me-md-auto text-center text-md-start">
                <div class="copyright">
                    &copy; Copyright <strong><span>Kelompok 1 PA 2</span></strong>. All Rights Reserved
                </div>
                <div class="credits">
                    
                </div>
            </div>
            <div class="social-links text-center text-md-right pt-3 pt-md-0">
                <a href="https://www.facebook.com/LittleStarMedanSchool?mibextid=ZbWKwL" class="facebook"><i class="bx bxl-facebook"></i></a>
            <a href="https://instagram.com/littlestar.medan?igshid=MzRlODBiNWFlZA==" class="instagram"><i class="bx bxl-instagram"></i></a>
            </div>
        </div>
    </footer><!-- End Footer -->

</main><!-- End #main -->
@endsection