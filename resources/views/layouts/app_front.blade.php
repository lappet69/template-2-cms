<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />

    <title>Home</title>


    <!-- Favicons -->
    <link href="{{ asset('front/assets/img/favicon.png') }}" rel="icon" />
    <link href="{{ asset('front/assets/img/apple-touch-icon.png') }}" rel="apple-touch-icon" />

    <!-- Google Fonts -->
    <link
        href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Raleway:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i"
        rel="stylesheet" />

    <!-- Vendor CSS Files -->
    <link href="{{ asset('front/assets/vendor/animate.css/animate.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('front/assets/vendor/aos/aos.css') }}" rel="stylesheet" />
    <link href="{{ asset('front/assets/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('front/assets/vendor/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet" />
    <link href="{{ asset('front/assets/vendor/boxicons/css/boxicons.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('front/assets/vendor/remixicon/remixicon.css') }}" rel="stylesheet" />
    <link href="{{ asset('front/assets/vendor/swiper/swiper-bundle.min.css') }}" rel="stylesheet" />

    <!-- Template Main CSS Files -->
    <link href="{{ asset('front/assets/css/variables.css') }}" rel="stylesheet" />

    <!-- Template Main CSS File -->
    <link href="{{ asset('front/assets/css/style.css') }}" rel="stylesheet" />
    <link href="{{ asset('front/assets/css/mobile-styles.css') }}" rel="stylesheet" />

    <meta content="" name="keywords" />

    <meta name='robots' content='index, follow' />

    <meta property="og:locale" content="id_ID" />

    @stack('meta')
    @stack('css')
    @stack('styles')
</head>

<body>

    @php
        $identitas = \App\Models\Identitas::where('active', '1')->limit(1)->first();
    @endphp

    @include('layouts.navbar_front')

    <main id="main">
        @yield('content')
    </main>
    <!-- End #main -->

    <!-- ======= Footer ======= -->
    <footer id="footer" class="footer">
        <!-- <div class="footer-card img-bg-footer" style="background-image: url('assets/img/footer-bg-1.png')"></div>
        <div class="footer-card2 img-bg-footer" style="background-image: url('assets/img/footer-bg-2.png')"></div> -->
        <div class="footer-top">
            <div class="container-academy">
                <div class="row">
                    <div class="col-12 col-md-12 col-lg-4 footer-contact mb-5">
                        <a href="index.html" class="logo me-auto">
                            <img src="{{ asset('front/assets/img/academy-logo.png') }}" alt=""
                                class="img-fluid mb-3" />
                        </a>
                        <h6 class="footer-loc mb-3">{{ $identitas->nama_gedung }}</h6>
                        <div class="footer-alamat mb-3">{{ $identitas->alamat_kantor }}</div>
                        <div class="footer-newsletter d-lg-none d-sm-block d-block">
                            <img src="{{ asset('front/assets/img/footer-img.png') }}" class="img-fluid w-100"
                                alt="" />
                        </div>
                    </div>

                    <div class="col-12 col-md-6 col-lg-5 footer-links mb-5">
                        <h2 class="mb-3">Program</h2>
                        <div class="row">
                            @foreach ($program as $pr)
                                <div class="col-12 col-sm-6 col-md-12 col-lg-6 mb-3">
                                    <h3>{{ $pr->title }}</h3>
                                    @php
                                        $courses = \App\Models\Content::where('parent_content_id', $pr->id)->get();
                                    @endphp

                                    <ul>
                                        @foreach ($courses as $c)
                                            <li>
                                                <i class="bx bx-chevron-right"></i>
                                                <a href="#">{{ $c->title }}</a>
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endforeach
                            <div class="footer-newsletter d-lg-block d-sm-none d-none">
                                <img src="{{ asset('front/assets/img/footer-img.png') }}" class="img-fluid w-100"
                                    alt="" />
                            </div>
                        </div>
                    </div>

                    <div class="col-12 col-md-6 col-lg-3 footer-links">
                        <h2 class="mb-3">Halaman</h2>
                        <a href="{{ route('about') }}">
                            <h3 class="mb-3">About Us</h3>
                        </a>
                        <a href="{{ route('registrasi') }}">
                            <h3 class="mb-3">Registrasi</h3>
                        </a>
                        <a target="_blank" href="{{ $konsultasi->subtitle }}">
                            <h3 class="mb-3">Konsultasi</h3>
                        </a>

                        <h6 class="mt-5 mb-3">Media Sosial</h6>
                        <div class="social-links">
                            {{-- <a href="{{ $identitas->facebook }}" class="facebook"><i
                                    class="bx bxl-facebook bx-sm"></i></a> --}}
                            <a href="{{ $identitas->instagram }}" target="_blank" class="instagram"><i
                                    class="bx bxl-instagram bx-sm"></i></a>
                            <a href="{{ $identitas->linkedin }}" target="_blank" class="linkedin"><i
                                    class="bx bxl-linkedin bx-sm"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <!-- End Footer -->

    <div id="preloader"></div>
    <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i
            class="bi bi-arrow-up-short"></i></a>
    <div class="wa-email">
        <a target="_blank" href="{{ $konsultasi->subtitle }}"
            class="d-flex align-items-center justify-content-center wa-bg"><i class="bi bi-whatsapp"></i></a>
        <a href="maiilto:{{ $identitas->email }}" class="d-flex align-items-center justify-content-center mail-bg"><i
                class="bi bi-envelope"></i></a>
    </div>
    <!-- jQuery -->
    <script src="{{ asset('back/adminlte/plugins/jquery/jquery.min.js') }}"></script>
    <!-- SweetAlert2 -->
    <script src="{{ asset('back/js/sweetalert2@11.js') }}"></script>

    <!-- Vendor JS Files -->
    <script src="{{ asset('front/assets/vendor/purecounter/purecounter_vanilla.js') }}"></script>
    <script src="{{ asset('front/assets/vendor/aos/aos.js') }}"></script>
    <script src="{{ asset('front/assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('front/assets/vendor/swiper/swiper-bundle.min.js') }}"></script>
    <script src="{{ asset('front/assets/vendor/php-email-form/validate.js') }}"></script>

    <!-- Template Main JS File -->
    <script src="{{ asset('front/assets/js/main.js') }}"></script>

    @stack('js')

    <script></script>
    @if (session('alert.success'))
        <script>
            $(document).ready(function() {
                Swal.fire({
                    icon: 'success',
                    title: '{{ session('alert.success') }}',
                    timer: 2000,
                    confirmButtonColor: '#3085d6',
                });
            });
        </script>
    @endif
    @if (session('alert.failed'))
        <script>
            $(document).ready(function() {
                Swal.fire({
                    icon: 'error',
                    title: '{{ session('alert.failed') }}',
                    confirmButtonColor: '#3085d6',
                });
            });
        </script>
    @endif
    @stack('scripts')
</body>

</html>
