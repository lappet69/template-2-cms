<!DOCTYPE html>
<html lang="en">

<head>
    @php
        $identitas = \App\Models\Content::where('active', 1)->where('section_id', 1)->limit(1)->first();
        $content = json_decode($identitas->content);
        $bidang_praktik_parent = \App\Models\Content::where('section_id', '=', 7)
            ->whereNull('parent_content_id')
            ->limit(1)
            ->first();
    @endphp
    <meta charset="utf-8" />
    <title>{{ $content->nama_website }} - {{ $title }}</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <meta content="" name="keywords" />
    <meta content="" name="description" />


    <!-- Favicons -->
    <link href="assets/img/favicon.png" rel="icon">
    <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,600;1,700&family=Roboto:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&family=Work+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap"
        rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="{{ asset('assets/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/aos/aos.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/glightbox/css/glightbox.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/swiper/swiper-bundle.min.css') }}" rel="stylesheet">

    <!-- Template Main CSS File -->
    <link href="{{ asset('assets/css/main.css') }}" rel="stylesheet">

    <!-- Icon Font Stylesheet -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet" />

    <!-- Libraries Stylesheet -->
    <link href="{{ asset('assets/lib/animate/animate.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/lib/owlcarousel/assets/owl.carousel.min.css') }}" rel="stylesheet" />

</head>

<body>

    @include('layouts.navbar_frontend')

    @yield('content')

    <!-- ======= Footer ======= -->
    <footer id="footer" class="footer">

        <div class="footer-content position-relative">
            <div class="container">
                <div class="row justify-content-between">

                    <div class="col-lg-4 col-md-6">
                        <div class="footer-info">
                            <h3> {{ $content->nama_website }}</h3>
                            <p>
                                {{ $content->meta_description }}
                            </p>
                            <div class="social-links d-flex mt-3">
                                <a class="btn btn-square me-1" href="{{ $content->twitter }}"><i
                                        class="fab fa-twitter"></i></a>
                                <a class="btn btn-square me-1" href="{{ $content->facebook }}"><i
                                        class="fab fa-facebook-f"></i></a>
                                <a class="btn btn-square me-1" href="{{ $content->youtube }}"><i
                                        class="fab fa-youtube"></i></a>
                                <a class="btn btn-square me-0" href="{{ $content->instagram }}"><i
                                        class="fab fa-instagram"></i></a>
                                <a class="btn btn-square me-0" href="{{ $content->linkedin }}"><i
                                        class="fab fa-linkedin-in"></i></a>
                            </div>
                        </div>
                    </div><!-- End footer info column-->

                    <div class="col-lg-3 col-md-3 footer-links">
                        <h4>Peta Situs</h4>
                        <ul>
                            <li><a href="{{ route('index') }}">Home</a></li>
                            <li><a href="{{ route('index') }}">Tentang Kami</a></li>
                            <li><a href="{{ route('area-praktek') }}">Area Praktek</a></li>
                            <li><a href="{{ route('tim-kami') }}">Tim Kami</a></li>
                            <li><a href="{{ route('artikel-publikasi') }}">Artikel & Publikasi</a>
                            </li>
                            <li><a href="{{ route('index') }}">Kontak Kami</a></li>
                        </ul>
                    </div><!-- End footer links column-->


                    <div class="col-lg-3 col-md-3 footer-links">
                        <h4>Info Kontak</h4>
                        <ul>
                            <li><a href=""class="text-light"> <i
                                        class="fa fa-map-marker-alt me-3"></i>{{ $content->alamat_kantor }}</a></li>
                            <li><a href="https://wa.me/{{ $content->no_wa }}"class="text-light"><i
                                        class="fa fa-phone-alt me-3"></i>{{ $content->no_wa }}</a></li>
                            <li><a href="mailto:{{ $content->email }}"class="text-light"><i
                                        class="fa fa-envelope me-3"></i>{{ $content->email }}</a></li>
                        </ul>
                    </div><!-- End footer links column-->

                </div>
            </div>
        </div>

        <div class="footer-legal text-center position-relative">
            <div class="container">
                <div class="copyright">
                    <span class="text-white"><a href="{{ route('index') }}"><i
                                class="fas fa-copyright text-light me-2"></i>{{ date('Y') . ' ' . $content->nama_website }}</a>,
                        All right reserved.</span>
                </div>
                <div class="credits">
                    Designed By <a class="border-bottom" target="_blank" href="https://romajunateknologi.com">CV.
                        Romajuna
                        Teknologi Firdaus</a>
                </div>
            </div>
        </div>

    </footer>
    <!-- End Footer -->

    <a href="#" class="scroll-top d-flex align-items-center justify-content-center"><i
            class="bi bi-arrow-up-short"></i></a>

    <div id="preloader"></div>

    <!-- Vendor JS Files -->
    <script src="{{ asset('assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/aos/aos.js') }}"></script>
    <script src="{{ asset('assets/vendor/glightbox/js/glightbox.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/isotope-layout/isotope.pkgd.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/swiper/swiper-bundle.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/purecounter/purecounter_vanilla.js') }}"></script>
    <script src="{{ asset('assets/vendor/php-email-form/validate.js') }}"></script>

    <!-- Template Main JS File -->
    <script src="{{ asset('assets/js/main.js') }}"></script>
</body>

</html>
