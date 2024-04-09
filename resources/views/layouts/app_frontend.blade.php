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

    <!-- Favicon -->
    <link href="img/favicon.ico" rel="icon" />

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&family=Poppins:wght@600;700&display=swap"
        rel="stylesheet" />

    <!-- Icon Font Stylesheet -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet" />

    <!-- Libraries Stylesheet -->
    <link href="{{ asset('assets/lib/animate/animate.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/lib/owlcarousel/assets/owl.carousel.min.css') }}" rel="stylesheet" />

    <!-- Customized Bootstrap Stylesheet -->
    <link href="{{ asset('assets/css/bootstrap.min.css') }}" rel="stylesheet" />

    <!-- Template Stylesheet -->
    <link href="{{ asset('assets/css/style.css') }}" rel="stylesheet" />
</head>

<body>
    <!-- Spinner Start -->
    <div id="spinner"
        class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
        <div class="spinner-grow text-primary" role="status"></div>
    </div>
    <!-- Spinner End -->

    @include('layouts.navbar_frontend')

    @yield('content')

    <!-- Footer Start -->
    <div class="container-fluid bg-dark footer mt-5 pt-5 wow fadeIn" data-wow-delay="0.1s">
        <div class="container py-5">
            <div class="row g-5">
                <div class="col-lg-3 col-md-6">
                    <h3 class="text-white mb-4">
                        {{ $content->nama_website }}
                    </h3>
                    <p>
                        {{ $content->meta_description }}
                    </p>
                    <div class="d-flex pt-2">
                        <a class="btn btn-square me-1" href="{{ $content->twitter }}"><i class="fab fa-twitter"></i></a>
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
                <div class="col-lg-3 col-md-6">
                    <h5 class="text-light mb-4">Info Kontak</h5>
                    <p>
                        <a href=""class="text-light"> <i
                                class="fa fa-map-marker-alt me-3"></i>{{ $content->alamat_kantor }}</a>
                    </p>
                    <p><a href="https://wa.me/{{ $content->no_wa }}"class="text-light"><i
                                class="fa fa-phone-alt me-3"></i>{{ $content->no_wa }}</a></p>
                    <p><a href="mailto:{{ $content->email }}"class="text-light"><i
                                class="fa fa-envelope me-3"></i>{{ $content->email }}</a></p>
                </div>
                <div class="col-lg-3 col-md-6">
                    <h5 class="text-light mb-4">Peta Situs</h5>
                    <a class="btn btn-link" href="{{ route('index') }}">Home</a>
                    <a class="btn btn-link" href="{{ route('index') }}">Tentang Kami</a>
                    <a class="btn btn-link" href="{{ route('area-praktek') }}">Area Praktek</a>
                    <a class="btn btn-link" href="{{ route('tim-kami') }}">Tim Kami</a>
                    <a class="btn btn-link" href="{{ route('artikel-publikasi') }}">Artikel & Publikasi</a>
                    <a class="btn btn-link" href="{{ route('index') }}">Kontak Kami</a>
                </div>
                <div class="col-lg-3 col-md-6">
                    <h5 class="text-light mb-4">Newsletter</h5>
                    <p>Dolor amet sit justo amet elitr clita ipsum elitr est.</p>
                    <div class="position-relative mx-auto" style="max-width: 400px">
                        <input class="form-control bg-transparent w-100 py-3 ps-4 pe-5" type="text"
                            placeholder="Your email" />
                        <button type="button" class="btn btn-secondary py-2 position-absolute top-0 end-0 mt-2 me-2">
                            SignUp
                        </button>
                    </div>
                </div>
            </div>
        </div>
        <div class="container-fluid copyright">
            <div class="container">
                <div class="row">
                    <div class="col-md-6 text-center text-md-start mb-3 mb-md-0">
                        <span class="text-white"><a href="{{ route('index') }}"><i
                                    class="fas fa-copyright text-light me-2"></i>{{ date('Y') . ' ' . $content->nama_website }}</a>,
                            All right reserved.</span>
                    </div>
                    <div class="col-md-6 text-center text-md-end">
                        <!--/*** This template is free as long as you keep the footer author’s credit link/attribution link/backlink. If you'd like to use the template without the footer author’s credit link/attribution link/backlink, you can purchase the Credit Removal License from "https://htmlcodex.com/credit-removal". Thank you for your support. ***/-->
                        Designed By <a class="border-bottom" target="_blank" href="https://romajunateknologi.com">CV.
                            Romajuna
                            Teknologi Firdaus</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Footer End -->

    <!-- Back to Top -->
    <a href="#" class="btn btn-lg btn-primary btn-lg-square back-to-top"><i class="bi bi-arrow-up"></i></a>

    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('assets/lib/wow/wow.min.js') }}"></script>
    <script src="{{ asset('assets/lib/easing/easing.min.js') }}"></script>
    <script src="{{ asset('assets/lib/waypoints/waypoints.min.js') }}"></script>
    <script src="{{ asset('assets/lib/owlcarousel/owl.carousel.min.js') }}"></script>
    <script src="{{ asset('assets/lib/counterup/counterup.min.js') }}"></script>

    <!-- Template Javascript -->
    <script src="{{ asset('assets/js/main.js') }}"></script>
</body>

</html>
