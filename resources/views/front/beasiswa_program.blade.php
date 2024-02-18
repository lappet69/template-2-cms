@extends('layouts.app_front')

@section('content')
    <!-- ======= Breadcrumbs ======= -->
    <div class="breadcrumbs">
        <div class="container-academy">
            <ol>
                <li>Home</li>
                <li>Beasiswa Program</li>
            </ol>
        </div>
    </div>
    <!-- End Breadcrumbs -->

    <!-- ======= Beassiswa Program Section ======= -->
    <section id="beasiswa-program" class="beasiswa-program">
        <div class="container-academy" data-aos="fade-up">
            <div class="beasiswa-program-card">
                <div class="row mb-3">
                    <div class="col-12 col-md-12 col-lg-7 order-1 order-lg-2" data-aos="fade-left" data-aos-delay="100">
                        <img src="{{ asset('front/assets/img/course-details-banner.png') }}" class="img-fluid" />

                        <div class="toc">
                            <div class="row">
                                <div class="col-6">
                                    <h6>Syarat Program:</h6>
                                    <ul>
                                        <li>Kirimkan CV</li>
                                        <li>Semua background dapat bergabung</li>
                                        <li>Usia maksimum 30 tahun</li>
                                        <li>
                                            wajib membuat essay alasan ingin mengikuti beasiswa
                                            ini minimal 500 kata
                                        </li>
                                    </ul>
                                </div>
                                <div class="col-6">
                                    <h6>Ketentuan Program</h6>
                                    <ul>
                                        <li>
                                            Berlangsungnya program kelas beasiswa akan ditentukan
                                            sesuai dengan ketersediaan kursi dari masing-masing
                                            program
                                        </li>
                                        <li>
                                            Beasiswa hanya dibuka untuk program Reguler Time
                                            Bootcamp
                                        </li>
                                        <li>
                                            Hanya Peserta yang memenuhi syarat yang akan dihubungi
                                            oleh Phincon Academy
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-md-12 col-lg-5 order-2 order-lg-1 content">
                        <h1>Program</h1>
                        <h1 class="subtitle">Beasiswa</h1>
                        <div class="row beasiswa-program-name">
                            <div class="col-6 mt-2">
                                <a href="">IOS Swift Bootcamp
                                    <hr />
                                </a>
                            </div>
                            <div class="col-6 mt-2">
                                <a href="">Android Kotlin Bootcamp
                                    <hr />
                                </a>
                            </div>
                            <div class="col-6 mt-2">
                                <a href="">Fullstack Javascript Bootcamp
                                    <hr />
                                </a>
                            </div>
                        </div>
                        <div class="beasiswa-program-step">
                            <h3>Langkah Pendaftaran Beasiswa</h3>
                            <div class="timeline">
                                <p>Periode Pendaftaran Beasiswa dibuka pada :</p>
                                <p>24.04.24</p>
                                <p>
                                    <a href="" class="btn btn-outline-secondary">Pendaftaran</a>
                                </p>
                                <p>Proses Penyaringan Berupa Screening CV dan Interview</p>
                                <p>
                                    Perserta yang berhasil, akan dihubungi oleh Phincon
                                    Academy
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 d-flex justify-content-end">
                        <div class="float-register">Daftar</div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- End Program Details Section -->
@endsection
