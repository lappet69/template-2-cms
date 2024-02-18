@extends('layouts.app_front')

@push('css')
    <style>
        .btn-register {
            margin-top: 20px;
            background: #33bc87;
            font-size: 14px;
            font-weight: bold;
            border-radius: 6px;
            color: white;
            width: 100%;
        }

        .day-learning,
        .day-prepare,
        .day-bootcamp,
        .day-duration {
            font-size: 14px;
        }
    </style>
@endpush

@section('content')
    @php
        $identitas = \App\Models\Identitas::where('active', '1')->limit(1)->first();

        $thumbnail = \App\Models\Asset::where('content_id', $detailcourse->id)
            ->where('keterangan', 'thumbnail')
            ->first();
    @endphp
    <!-- ======= Breadcrumbs ======= -->
    <div class="breadcrumbs">
        <div class="container-academy">
            <ol>
                <li>Home</li>
                <li>Program</li>
                <li>{{ $detailcourse->title . ' ' . $detailcourse->subtitle }}</li>
            </ol>
        </div>
    </div>
    <!-- End Breadcrumbs -->

    <!-- ======= Program Details Section ======= -->
    <section id="program-details" class="program-details">
        <div class="container-academy" data-aos="fade-up">
            <div class="program-details-card">
                <div class="row">
                    <div class="col-lg-6 order-1 order-lg-2" data-aos="fade-left" data-aos-delay="100">
                        @if ($thumbnail)
                            <img src="{{ asset('front/assets/img/' . $thumbnail->thumbnail) }}" class="img-fluid"
                                style="object-fit: contain" />
                        @endif
                    </div>
                    <div class="col-lg-6 order-2 order-lg-1 content">
                        <h1>{{ $detailcourse->title }}</h1>
                        <h1 class="subtitle">{{ $detailcourse->subtitle }}</h1>
                        <div class="program-details-content">
                            <p>{{ $detailcourse->short_description }}</p>
                            <a class="btn btn-register" href="{{ $konsultasi->subtitle }}">Hubungi Kami</a>
                        </div>
                    </div>
                </div>

                @if ($detailcourse->content)
                    @php
                        $section = json_decode($detailcourse->content, true);
                    @endphp
                @else
                    @php
                        $section['sub_konten'][0] = null;
                        $section['sub_konten'][1] = null;
                        $section['sub_konten'][2] = null;
                        $section['sub_konten'][3] = null;
                        $section['sub_konten'][4] = null;
                        $section['sub_konten'][5] = null;
                        $section['sub_konten'][6] = null;
                    @endphp
                @endif

                @php
                    $why = isset($section['sub_konten'][0]) ? $section['sub_konten'][0] : '';
                    $destination = isset($section['sub_konten'][1]) ? $section['sub_konten'][1] : '';
                    $alumni_working = isset($section['sub_konten'][2]) ? $section['sub_konten'][2] : '';
                    $career_support = isset($section['sub_konten'][3]) ? $section['sub_konten'][3] : '';
                    $alumni_project = isset($section['sub_konten'][4]) ? $section['sub_konten'][4] : '';
                    $testimonial = isset($section['sub_konten'][5]) ? $section['sub_konten'][5] : '';
                    $faq = isset($section['sub_konten'][6]) ? $section['sub_konten'][6] : '';
                @endphp
                @if (isset($why['konten_title']))
                    <div class="program-details-why">
                        <h1 class="mt-5">{{ $why['konten_title'] }}</h1>
                        <div class="program-details-why-detail">
                            <div class="row">
                                @foreach ($why['konten_description'] as $description)
                                    <div class="col-12 col-sm-6 col-lg-4 mb-3">
                                        <h2 class="fw-bold mb-3">{{ $description['sub_konten_title'] }}:</h2>
                                        <p class="fw-normal">{{ $description['sub_konten_description'] }}</p>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </section>
    <!-- End Program Details Section -->

    @if (isset($destination['konten_title']))
        <!-- ======= Potential Career Section ======= -->
        <section id="potential-career" class="potential-career">
            <div class="container-academy" data-aos="fade-up">
                <div class="potential-career-card">
                    <h1>{{ $destination['konten_title'] }}</h1>
                    <div class="potential-career-body">
                        <div class="row">
                            @foreach ($destination['konten_description'] as $description)
                                <div class="col-12 col-sm-6 col-lg-3">
                                    <img src="{{ asset('front/assets/img/' . $description['sub_konten_image']) }}"
                                        class="img-fluid" alt="" />
                                </div>
                            @endforeach
                            {{-- <div class="col-12 col-sm-6 col-lg-3">
                                <img src="{{ asset('front/assets/img/potential-career-2.png') }}" class="img-fluid"
                                    alt="" />
                            </div>
                            <div class="col-12 col-sm-6 col-lg-3">
                                <img src="{{ asset('front/assets/img/potential-career-3.png') }}" class="img-fluid"
                                    alt="" />
                            </div>
                            <div class="col-12 col-sm-6 col-lg-3">
                                <img src="{{ asset('front/assets/img/potential-career-4.png') }}" class="img-fluid"
                                    alt="" />
                            </div> --}}
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- End Program Details Section -->
    @endif

    @if (isset($alumni_working['konten_title']))
        <!-- ======= Alumni Company Section ======= -->
        <section id="alumni-company" class="alumni-company">
            <h1 class="mb-5">{{ $alumni_working['konten_title'] }}</h1>
            <div class="container-academy" data-aos="fade-up">
                <div class="row">
                    @foreach ($alumni_working['konten_description'] as $description)
                        <div class="col-6 col-sm-6 col-md-4 col-lg-2 mb-5">
                            <div class="text-center">
                                <img src="{{ asset('front/assets/img/' . $description['sub_konten_image']) }}"
                                    class="img-fluid w-75 img-home-client" alt="" />
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
        <!-- End Alumni Company Section -->
    @endif

    <!-- ======= Bootcamp Phase Section ======= -->
    <section id="bootcamp-phase" class="bootcamp-phase">
        <div class="container-academy" data-aos="fade-up">
            <h1>Fase Pembelajaran Bootcamp Swift untuk iOS</h1>
            <div class="bootcamp-phase-body">
                <div class="row">
                    @foreach ($detailcourse->childcontent as $key => $item)
                        <div class="col-12 col-lg-6 col-md-6">
                            <div class="faq-list">
                                <ul class="bootcamp-phase-list-li">
                                    <li data-aos="fade-up" data-aos-delay="100">
                                        <a data-bs-toggle="collapse" class="{{ $key == 0 ? 'collapse' : 'collapsed' }}"
                                            data-bs-target="#faq-list-{{ $item->id }}">{{ $item->title }}
                                            <br />
                                            <p>{{ $item->short_description }}</p>
                                            <i class="bx bx-chevron-down icon-show"></i>
                                            <i class="bx bx-chevron-up icon-close"></i>
                                        </a>

                                        <div id="faq-list-{{ $item->id }}"
                                            class="faq-list-detail collapse {{ $key == 0 ? 'show' : '' }}"
                                            data-bs-parent=".faq-list">
                                            <div>
                                                {!! $item->content !!}
                                            </div>
                                        </div>
                                    </li>

                                    {{-- <li data-aos="fade-up" data-aos-delay="200">
                                        <a data-bs-toggle="collapse" data-bs-target="#faq-list-2" class="collapsed">IOS Fase
                                            2 <br />
                                            <p>
                                                Kembangkan aplikasi dengan kode yang bersih dan
                                                arsitektur MVVM menggunakan RXSwift untuk performa
                                                yang optimal dan responsif
                                            </p>
                                            <i class="bx bx-chevron-down icon-show"></i><i
                                                class="bx bx-chevron-up icon-close"></i>
                                        </a>
                                        <div id="faq-list-2" class="collapse faq-list-detail" data-bs-parent=".faq-list">
                                            <h3>Kurikulum yang dipelajari</h3>
                                            <div class="point"></div>
                                            Penguasaan Swift Komprehensif <br />
                                            <p>
                                                Mulai dari dasar Swift, pengaturan lingkungan
                                                pengembangan, sintaks, struktur kontrol, fungsi,
                                                hingga pemrograman berorientasi objek dengan kelas,
                                                objek, struktur data, dan koleksi, untuk menghasilkan
                                                aplikasi iOS yang kuat dan efisien
                                            </p>
                                            <div class="point"></div>
                                            Platform atau Tools yang akan digunakan <br />
                                            <div class="d-inline-block">
                                                <img src="{{ asset('front/assets/img/tools-1.png') }}" alt="" />
                                                <img src="{{ asset('front/assets/img/tools-2.png') }}" alt="" />
                                                <img src="{{ asset('front/assets/img/tools-3.png') }}" alt="" />
                                                <img src="{{ asset('front/assets/img/tools-4.png') }}" alt="" />
                                            </div>
                                        </div>
                                    </li> --}}
                                </ul>
                            </div>
                        </div>
                    @endforeach

                    {{-- <div class="col-12 col-lg-6">
                        <div class="faq-list">
                            <ul>
                                <li data-aos="fade-up" data-aos-delay="300">
                                    <a data-bs-toggle="collapse" data-bs-target="#faq-list-3" class="collapsed">IOS Fase
                                        1 <br />
                                        <p>
                                            Mempelajari kerangka kerja dasar untuk membangun
                                            aplikasi pertama IOS kamu dengan XCode
                                        </p>
                                        <i class="bx bx-chevron-down icon-show"></i><i
                                            class="bx bx-chevron-up icon-close"></i>
                                    </a>
                                    <div id="faq-list-3" class="collapse faq-list-detail" data-bs-parent=".faq-list">
                                        <h3>Kurikulum yang dipelajari</h3>
                                        <div class="point"></div>
                                        Penguasaan Swift Komprehensif <br />
                                        <p>
                                            Mulai dari dasar Swift, pengaturan lingkungan
                                            pengembangan, sintaks, struktur kontrol, fungsi,
                                            hingga pemrograman berorientasi objek dengan kelas,
                                            objek, struktur data, dan koleksi, untuk menghasilkan
                                            aplikasi iOS yang kuat dan efisien
                                        </p>
                                        <div class="point"></div>
                                        Platform atau Tools yang akan digunakan <br />
                                        <div class="d-inline-block">
                                            <img src="{{ asset('front/assets/img/tools-1.png') }}" alt="" />
                                            <img src="{{ asset('front/assets/img/tools-2.png') }}" alt="" />
                                            <img src="{{ asset('front/assets/img/tools-3.png') }}" alt="" />
                                            <img src="{{ asset('front/assets/img/tools-4.png') }}" alt="" />
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div> --}}
                </div>
            </div>
            <button type="button" class="btn btn-register" data-bs-toggle="modal"
                data-bs-target="#modal-download-syllabus">
                Download Silabus
            </button>

            <!-- Modal -->
            <div class="modal fade" id="modal-download-syllabus" data-bs-backdrop="static" data-bs-keyboard="false"
                tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body modal-syllabus-body">
                            <h2>Silabus Program IOS Swift</h2>
                            <p>
                                Isi formulir dibawah ini untuk mendapatkan silabus melalui
                                email
                            </p>
                            <div class="row">
                                <div class="col-6">
                                    <div class="form-group">
                                        <label class="form-label" for="nama_ktp">Nama Depan Sesuai KTP</label>
                                        <input type="text" id="nama_ktp" class="form-control form-control-lg"
                                            name="nama_ktp" />
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label class="form-label" for="nama_ktp">Nama Belakang Sesuai KTP</label>
                                        <input type="text" id="nama_ktp" class="form-control form-control-lg"
                                            name="nama_ktp" />
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-6">
                                    <div class="form-group">
                                        <label class="form-label" for="nama_ktp">No. HP (WhatsApp)</label>
                                        <input type="text" id="nama_ktp" class="form-control form-control-lg"
                                            name="nama_ktp" />
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label class="form-label" for="nama_ktp">Email</label>
                                        <input type="email" id="nama_ktp" class="form-control form-control-lg"
                                            name="nama_ktp" />
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                                Kembali
                            </button>
                            <button type="button" class="btn btn-send-syllabus">
                                Kirimkan Silabus
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <img src="{{ asset('front/assets/img/bootcamp-phase-bg.png') }}" class="img-fluid" alt="" />
    </section>
    <!-- End Bootcamp Phase Section -->

    @if (isset($career_support['konten_title']))
        <!-- ======= Career Support Section ======= -->
        <section id="career-support" class="career-support">
            <div class="container-academy" data-aos="fade-up">
                <div class="career-support-card">
                    <h1>{{ $career_support['konten_title'] }}</h1>
                    <div class="career-support-body">
                        <div class="row">
                            @foreach ($career_support['konten_description'] as $description)
                                <div class="col-12 col-sm-6 col-lg-4 mb-3">
                                    <h4 class="mb-2">{{ $description['sub_konten_title'] }}</h4>
                                    <p>{{ $description['sub_konten_description'] }} </p>
                                </div>
                            @endforeach
                            {{-- <div class="col-12 col-sm-6 col-lg-4 mb-3">
                                <h4 class="mb-2">Akses Eksklusif ke Rekruter</h4>
                                <p>
                                    Langkah Kamu lulus, kamu akan dipermudah dengan akses ke
                                    sesi wawancara dan peluang langsung untuk berkarir di
                                    Phincon, Pintraco Group dan dari jaringan Hiring Partners
                                    terpercaya kami
                                </p>
                            </div>
                            <div class="col-12 col-sm-6 col-lg-4 mb-3">
                                <h4 class="mb-2">Mentor Karir</h4>
                                <p>
                                    Dukungan karier yang personal dan terstruktur, untuk memandu
                                    Kamu melalui setiap langkah hingga mencapai kesuksesan
                                    karier.
                                </p>
                            </div> --}}
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- End Career Support Section -->
    @endif

    <!-- ======= Location Section ======= -->
    <section id="location" class="location">
        <div class="container-academy" data-aos="fade-up">
            <div class="location-card">
                <div class="row">
                    <div class="col-12 col-lg-6">
                        <div class="location-body">
                            <h1>Lokasi</h1>
                            <h2>{{ $identitas->nama_gedung }}</h2>
                            <p>{{ $identitas->alamat_kantor }}</p>
                            <div class="row contact">
                                <div class="col-lg-6 col-6">
                                    <table>
                                        <tr>
                                            <td rowspan="2"><i class="bi bi-envelope"></i></td>
                                            <td class="location-label">Email</td>
                                        </tr>
                                        <tr>
                                            <td class="location-input">{{ $identitas->email }}</td>
                                        </tr>
                                    </table>
                                </div>
                                <div class="col-lg-6 col-6">
                                    <table>
                                        <tr>
                                            <td rowspan="2">
                                                <i class="bi bi-telephone-fill"></i>
                                            </td>
                                            <td class="location-label">Phone</td>
                                        </tr>
                                        <tr>
                                            <td class="location-input">{{ $identitas->no_telp }}</td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-lg-6 location-bg">
                        <img src="{{ asset('front/assets/img/location-bg.png') }}" class="img-fluid mt-lg-0 mt-3"
                            alt="" />
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- End Location Section -->

    <!-- ======= Program Price Section ======= -->
    {{-- <section id="bootcamp-price" class="bootcamp-price">
        <div class="container-academy" data-aos="fade-up">
            <h1>Biaya dan Jadwal Program</h1>
            <div class="bootcamp-price-body">
                <div class="row">
                    <div class="col-12 col-lg-6">
                        <div class="amount">
                            <div class="line-hr"></div>
                            <p>
                                <span>Biaya Program<br /></span> Rp. 5.000.000
                            </p>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <div class="batch">
                            <div class="loop-batch">
                                <p class="mb-3">Batch 10 <span>Ios Swift Bootcamp</span></p>
                                <div class="row">
                                    <div class="col-12 col-sm-4 col-lg-2 mb-3 day-learning">
                                        Senin - Jumat<br />09:00 - 17.00 WIB
                                    </div>
                                    <div class="col-12 col-sm-4 col-lg-2 mb-3 day-prepare">
                                        Persiapan<br />01 Januari 2024
                                    </div>
                                    <div class="col-12 col-sm-4 col-lg-2 mb-3 day-bootcamp">
                                        Fase Bootcamp<br />20 Januari 2024
                                    </div>
                                    <div class="col-6 col-sm-6 col-lg-2 mb-3 day-duration">
                                        Durasi 16 Minggu<br />
                                        <hr />
                                    </div>
                                    <div class="col-6 col-sm-6 col-lg-2 mb-3 day-button">
                                        <button class="btn btn-register">Daftar</button>
                                    </div>
                                </div>
                            </div>
                            <div class="loop-batch">
                                <p>Batch 10 <span>Ios Swift Bootcamp</span></p>
                                <div class="batch-desc">
                                    <div class="d-inline-block day-learning">
                                        Senin - Jumat<br />09:00 - 17.00 WIB
                                    </div>
                                    <div class="d-inline-block day-prepare">
                                        Persiapan<br />01 Januari 2024
                                    </div>
                                    <div class="d-inline-block day-bootcamp">
                                        Fase Bootcamp<br />20 Januari 2024
                                    </div>
                                    <div class="d-inline-block day-duration">
                                        Durasi 16 Minggu<br />
                                        <hr />
                                    </div>
                                    <div class="d-inline-block day-button">
                                        <button class="btn btn-register">Daftar</button>
                                    </div>
                                </div>
                            </div>
                            <div class="loop-batch">
                                <p>Batch 10 <span>Ios Swift Bootcamp</span></p>
                                <div class="batch-desc">
                                    <div class="d-inline-block day-learning">
                                        Senin - Jumat<br />09:00 - 17.00 WIB
                                    </div>
                                    <div class="d-inline-block day-prepare">
                                        Persiapan<br />01 Januari 2024
                                    </div>
                                    <div class="d-inline-block day-bootcamp">
                                        Fase Bootcamp<br />20 Januari 2024
                                    </div>
                                    <div class="d-inline-block day-duration">
                                        Durasi 16 Minggu<br />
                                        <hr />
                                    </div>
                                    <div class="d-inline-block day-button">
                                        <button class="btn btn-register">Daftar</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section> --}}
    <!-- End Program Price Section -->

    @if (isset($alumni_project['konten_title']))
        <!-- ======= Alumni Project Section ======= -->
        <section id="alumni-project" class="alumni-project">
            <div class="container-academy">
                <div class="section-title">
                    <h2>{{ $alumni_project['konten_title'] }}</h2>
                </div>

                <div class="alumni-project-slider swiper" data-aos="fade-up" data-aos-delay="100">
                    <div class="swiper-wrapper">

                        @foreach ($alumni_project['konten_description'] as $description)
                            <div class="swiper-slide">
                                <div class="alumni-project-item">
                                    <div class="alumni-project-body">
                                        <img src="{{ asset('front/assets/img/' . $description['sub_konten_image']) }}"
                                            class="alumni-project-img" alt="" />

                                        <div class="alumni-project-content">
                                            <div class="alumni-project-desc">
                                                {{ $description['sub_konten_description'] }}
                                            </div>
                                            <div class="alumni-project-link">
                                                <h4 class="mb-1"><a href="{{ $description['sub_konten_title'] }}">Link
                                                        to Project</a></h4>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- End testimonial item -->
                        @endforeach

                        {{-- <div class="swiper-slide">
                            <div class="alumni-project-item">
                                <div class="alumni-project-body">
                                    <img src="{{ asset('front/assets/img/course-2.jpg') }}" class="alumni-project-img"
                                        alt="" />
                                    <div class="alumni-project-content">
                                        <h2>Shoptopedia</h2>
                                        <p>Nama :</p>
                                        <p>Batch :</p>
                                        <p class="alumni-project-desc">
                                            Lorem ipsum dolor sit amet, consectetur adipiscing elit,
                                            sed do eiusmod tempor incididunt ut labore et dolore
                                            magna aliqua. Ut enim ad minim veniam, quis
                                        </p>
                                        <div class="alumni-project-link">
                                            <h4>Link to Project</h4>
                                            <a href="www.behance.com">www.behance.com</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- End testimonial item -->

                        <div class="swiper-slide">
                            <div class="alumni-project-item">
                                <div class="alumni-project-body">
                                    <img src="{{ asset('front/assets/img/course-3.jpg') }}" class="alumni-project-img"
                                        alt="" />

                                    <div class="alumni-project-content">
                                        <h2>Shoptopedia</h2>
                                        <p>Nama :</p>
                                        <p>Batch :</p>
                                        <p class="alumni-project-desc">
                                            Lorem ipsum dolor sit amet, consectetur adipiscing elit,
                                            sed do eiusmod tempor incididunt ut labore et dolore
                                            magna aliqua. Ut enim ad minim veniam, quis
                                        </p>
                                        <div class="alumni-project-link">
                                            <h4 class="mb-1"><a href="www.behance.com">Link to Project</a></h4>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- End testimonial item -->

                        <div class="swiper-slide">
                            <div class="alumni-project-item">
                                <div class="alumni-project-body">
                                    <img src="{{ asset('front/assets/img/course-2.jpg') }}" class="alumni-project-img"
                                        alt="" />
                                    <div class="alumni-project-content">
                                        <h2>Shoptopedia</h2>
                                        <p>Nama :</p>
                                        <p>Batch :</p>
                                        <p class="alumni-project-desc">
                                            Lorem ipsum dolor sit amet, consectetur adipiscing elit,
                                            sed do eiusmod tempor incididunt ut labore et dolore
                                            magna aliqua. Ut enim ad minim veniam, quis
                                        </p>
                                        <div class="alumni-project-link">
                                            <h4 class="mb-1"><a href="www.behance.com">Link to Project</a></h4>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- End testimonial item -->

                        <div class="swiper-slide">
                            <div class="alumni-project-item">
                                <div class="alumni-project-body">
                                    <img src="{{ asset('front/assets/img/course-1.jpg') }}" class="alumni-project-img"
                                        alt="" />

                                    <div class="alumni-project-content">
                                        <h2>Shoptopedia</h2>
                                        <p>Nama :</p>
                                        <p>Batch :</p>
                                        <p class="alumni-project-desc">
                                            Lorem ipsum dolor sit amet, consectetur adipiscing elit,
                                            sed do eiusmod tempor incididunt ut labore et dolore
                                            magna aliqua. Ut enim ad minim veniam, quis
                                        </p>
                                        <div class="alumni-project-link">
                                            <h4>Link to Project</h4>
                                            <a href="www.behance.com">www.behance.com</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- End testimonial item --> --}}
                    </div>
                    <div class="swiper-button-prev" id="arrow-prev-review"></div>
                    <div class="swiper-button-next" id="arrow-next-review"></div>
                </div>
            </div>
        </section>
        <!-- End Alumni Project Section -->
    @endif

    @if (isset($testimonial['konten_title']))
        <!-- ======= Course Testimonies Section ======= -->
        <section id="testimonials" class="testimonials">
            <div class="container-academy">
                <div class="section-title">
                    <h2>{{ $testimonial['konten_title'] }}</h2>
                </div>
                <div class="testimonials-slider swiper" data-aos="fade-up" data-aos-delay="100">
                    <div class="swiper-wrapper">
                        @foreach ($testimonial['konten_description'] as $description)
                            <div class="swiper-slide">
                                <div class="testimonial-item">
                                    <div class="testimonial-content">
                                        <img src="{{ asset('front/assets/img/' . $description['sub_konten_image']) }}"
                                            class="testimonial-img rounded-circle" alt="" />
                                        <p>{{ $description['sub_konten_description'] }}</p>
                                        <div class="testimonial-profile">
                                            <h3>{{ $description['sub_konten_title'] }}</h3>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- End testimonial item -->
                        @endforeach

                        {{-- <div class="swiper-slide">
                            <div class="testimonial-item">
                                <div class="testimonial-content">
                                    <img src="assets/img/testimonials/Muhammad Fahmi.png" class="testimonial-img"
                                        alt="" />
                                    <p>"iOS Swift Bootcamp di Phincon Academy ini telah mengubah cara saya mempelajari iOS
                                        development. Dua bulan intens belajar 'learn by doing' dengan ahli industri telah
                                        meningkatkan keterampilan saya dan memperkuat motivasi karir saya."</p>
                                    <div class="testimonial-profile">
                                        <h3>Muhammad Fahmi</h3>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- End testimonial item -->

                        <div class="swiper-slide">
                            <div class="testimonial-item">
                                <div class="testimonial-content">
                                    <img src="assets/img/testimonials/Kaleb Gomgom Edward.png" class="testimonial-img"
                                        alt="" />
                                    <p>"Melalui iOS Swift Bootcamp di Phincon Academy, saya merasakan keasyikan belajar yang
                                        efektif. Mentor yang humble dan pendekatan 'learn by doing' benar-benar meningkatkan
                                        kemampuan saya dalam clean code dan swift, menyiapkan saya untuk projek IT nyata."
                                    </p>
                                    <div class="testimonial-profile">
                                        <h3>Kaleb Gomgom Edward</h3>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- End testimonial item -->

                        <div class="swiper-slide">
                            <div class="testimonial-item">
                                <div class="testimonial-content">
                                    <img src="assets/img/testimonials/Faiz Athaya Ramadhan.png" class="testimonial-img"
                                        alt="" />
                                    <p>"Di Phincon Academy, dari tidak mengenal Swift, saya kini mahir dalam clean code dan
                                        arsitektur MVVM. Pendekatan instruktur yang mendalam dan sesi diskusi intensif
                                        membuka
                                        jalan saya dalam dunia kerja IT."</p>
                                    <div class="testimonial-profile">
                                        <h3>Faiz Athaya Ramadhan</h3>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- End testimonial item -->

                        <div class="swiper-slide">
                            <div class="testimonial-item">
                                <div class="testimonial-content">
                                    <img src="assets/img/testimonials/Ibrohim Husain.png" class="testimonial-img"
                                        alt="" />
                                    <p>"Bootcamp iOS Swift di Phincon Academy memberikan saya pengalaman belajar yang luar
                                        biasa
                                        dengan instruktur yang interaktif dan praktis, mengajarkan keterampilan teknis dan
                                        nilai-nilai penting seperti manajemen waktu, yang sangat relevan untuk kebutuhan
                                        industri IT saat ini."</p>
                                    <div class="testimonial-profile">
                                        <h3>Ibrohim Husain</h3>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- End testimonial item -->

                        <div class="swiper-slide">
                            <div class="testimonial-item">
                                <div class="testimonial-content">
                                    <img src="assets/img/testimonials/Rizco Renova.png" class="testimonial-img"
                                        alt="" />
                                    <p>"Bootcamp iOS Swift di Phincon Academy ini mengubah saya dari amatir menjadi
                                        developer
                                        iOS yang terampil. Dalam waktu singkat, saya telah menguasai Swift, mempelajari
                                        UIKit
                                        hingga reactive programming, siap untuk sukses di industri IT."</p>
                                    <div class="testimonial-profile">
                                        <h3>Rizco Renova</h3>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- End testimonial item --> --}}
                    </div>
                    <div class="swiper-button-prev" id="prev-arrow-testi"></div>
                    <div class="swiper-button-next" id="next-arrow-testi"></div>
                </div>
            </div>
        </section>
        <!-- End Popular Courses Section -->
    @endif

    @if (isset($faq['konten_title']))
        <!-- ======= Frequently Asked Questions Section ======= -->
        <section id="faq" class="faq">
            <div class="container-academy" data-aos="fade-up">
                <div class="section-title">
                    <h2>{{ $faq['konten_title'] }}</h2>
                </div>

                <div class="faq-list">
                    <ul>
                        @php
                            $delay = 0;
                        @endphp
                        @foreach ($faq['konten_description'] as $index => $description)
                            <li data-aos="fade-up" data-aos-delay="{{ $delay + 100 }}">
                                <i class="bx bx-help-circle icon-help"></i>
                                <a data-bs-toggle="collapse" class="collapse {{ $index == 0 ? '' : 'collapsed' }}"
                                    data-bs-target="#faq-list-{{ $index }}">{{ $description['sub_konten_title'] }}
                                    <i class="bx bx-chevron-down icon-show"></i><i
                                        class="bx bx-chevron-up icon-close"></i></a>
                                <div id="faq-list-{{ $index }}" class="collapse {{ $index == 0 ? 'show' : '' }}"
                                    data-bs-parent=".faq-list">
                                    <p>{{ $description['sub_konten_description'] }}</p>
                                </div>
                            </li>
                        @endforeach

                        {{-- <li data-aos="fade-up" data-aos-delay="200">
                            <i class="bx bx-help-circle icon-help"></i>
                            <a data-bs-toggle="collapse" data-bs-target="#faq-list-2" class="collapsed">Apakah ada biaya
                                pendaftaran yang harus dibayarkan?
                                <i class="bx bx-chevron-down icon-show"></i><i
                                    class="bx bx-chevron-up icon-close"></i></a>
                            <div id="faq-list-2" class="collapse" data-bs-parent=".faq-list">
                                <p>
                                    Tidak, Kamu tidak perlu membayar biaya pendaftaran. Jadi
                                    Silakan kamu submit data diri kamu di didalam form. Kemudian
                                    lanjutkan ke pembayaran program yang Kamu pilih ini dengan
                                    metode yang tersedia
                                </p>
                            </div>
                        </li>

                        <li data-aos="fade-up" data-aos-delay="300">
                            <i class="bx bx-help-circle icon-help"></i>
                            <a data-bs-toggle="collapse" data-bs-target="#faq-list-3" class="collapsed">Bagaimana metode
                                pembayaran yang digunakan dalam bootcamp
                                ini? <i class="bx bx-chevron-down icon-show"></i><i
                                    class="bx bx-chevron-up icon-close"></i></a>
                            <div id="faq-list-3" class="collapse" data-bs-parent=".faq-list">
                                <p>
                                    Bootcamp kami menyediakan pilihan pembayaran melalui Virtual
                                    Account, Debit Card, dan Credit Card, memastikan proses yang
                                    mudah dan nyaman untuk Kamu. Pilih metode yang paling sesuai
                                    untuk memulai perjalanan coding Kamu tanpa repot.
                                </p>
                            </div>
                        </li>

                        <li data-aos="fade-up" data-aos-delay="400">
                            <i class="bx bx-help-circle icon-help"></i>
                            <a data-bs-toggle="collapse" data-bs-target="#faq-list-4" class="collapsed">Apakah biaya
                                program
                                ini dapat dikembalikan setelah
                                pembayaran? <i class="bx bx-chevron-down icon-show"></i><i
                                    class="bx bx-chevron-up icon-close"></i></a>
                            <div id="faq-list-4" class="collapse" data-bs-parent=".faq-list">
                                <p>
                                    Molestie a iaculis at erat pellentesque adipiscing commodo.
                                    Dignissim suspendisse in est ante in. Nunc vel risus commodo
                                    viverra maecenas accumsan. Sit amet nisl suscipit adipiscing
                                    bibendum est. Purus gravida quis blandit turpis cursus in.
                                </p>
                            </div>
                        </li>

                        <li data-aos="fade-up" data-aos-delay="500">
                            <i class="bx bx-help-circle icon-help"></i>
                            <a data-bs-toggle="collapse" data-bs-target="#faq-list-5" class="collapsed">Spesifikasi
                                laptop
                                atau PC apa yang dibutuhkan untuk
                                mengikuti kursus ini?
                                <i class="bx bx-chevron-down icon-show"></i><i
                                    class="bx bx-chevron-up icon-close"></i></a>
                            <div id="faq-list-5" class="collapse" data-bs-parent=".faq-list">
                                <p>
                                    Laoreet sit amet cursus sit amet dictum sit amet justo.
                                    Mauris vitae ultricies leo integer malesuada nunc vel.
                                    Tincidunt eget nullam non nisi est sit amet. Turpis nunc
                                    eget lorem dolor sed. Ut venenatis tellus in metus vulputate
                                    eu scelerisque.
                                </p>
                            </div>
                        </li>
                        <li data-aos="fade-up" data-aos-delay="600">
                            <i class="bx bx-help-circle icon-help"></i>
                            <a data-bs-toggle="collapse" data-bs-target="#faq-list-6" class="collapsed">Berapa lama
                                proses
                                belajar di bootcamp ini?
                                <i class="bx bx-chevron-down icon-show"></i><i
                                    class="bx bx-chevron-up icon-close"></i></a>
                            <div id="faq-list-6" class="collapse" data-bs-parent=".faq-list">
                                <p>
                                    Laoreet sit amet cursus sit amet dictum sit amet justo.
                                    Mauris vitae ultricies leo integer malesuada nunc vel.
                                    Tincidunt eget nullam non nisi est sit amet. Turpis nunc
                                    eget lorem dolor sed. Ut venenatis tellus in metus vulputate
                                    eu scelerisque.
                                </p>
                            </div>
                        </li>
                        <li data-aos="fade-up" data-aos-delay="700">
                            <i class="bx bx-help-circle icon-help"></i>
                            <a data-bs-toggle="collapse" data-bs-target="#faq-list-7" class="collapsed">Apakah saya bisa
                                mengikuti bootcamp ini secara paruh waktu?
                                <i class="bx bx-chevron-down icon-show"></i><i
                                    class="bx bx-chevron-up icon-close"></i></a>
                            <div id="faq-list-7" class="collapse" data-bs-parent=".faq-list">
                                <p>
                                    Laoreet sit amet cursus sit amet dictum sit amet justo.
                                    Mauris vitae ultricies leo integer malesuada nunc vel.
                                    Tincidunt eget nullam non nisi est sit amet. Turpis nunc
                                    eget lorem dolor sed. Ut venenatis tellus in metus vulputate
                                    eu scelerisque.
                                </p>
                            </div>
                        </li>
                        <li data-aos="fade-up" data-aos-delay="800">
                            <i class="bx bx-help-circle icon-help"></i>
                            <a data-bs-toggle="collapse" data-bs-target="#faq-list-8" class="collapsed">Apakah saya akan
                                mendapat sertifikat setelah lulus?
                                <i class="bx bx-chevron-down icon-show"></i><i
                                    class="bx bx-chevron-up icon-close"></i></a>
                            <div id="faq-list-8" class="collapse" data-bs-parent=".faq-list">
                                <p>
                                    Laoreet sit amet cursus sit amet dictum sit amet justo.
                                    Mauris vitae ultricies leo integer malesuada nunc vel.
                                    Tincidunt eget nullam non nisi est sit amet. Turpis nunc
                                    eget lorem dolor sed. Ut venenatis tellus in metus vulputate
                                    eu scelerisque.
                                </p>
                            </div>
                        </li>
                        <li data-aos="fade-up" data-aos-delay="900">
                            <i class="bx bx-help-circle icon-help"></i>
                            <a data-bs-toggle="collapse" data-bs-target="#faq-list-9" class="collapsed">Apakah saya akan
                                dicarikan kerja setelah lulus?
                                <i class="bx bx-chevron-down icon-show"></i><i
                                    class="bx bx-chevron-up icon-close"></i></a>
                            <div id="faq-list-9" class="collapse" data-bs-parent=".faq-list">
                                <p>
                                    Laoreet sit amet cursus sit amet dictum sit amet justo.
                                    Mauris vitae ultricies leo integer malesuada nunc vel.
                                    Tincidunt eget nullam non nisi est sit amet. Turpis nunc
                                    eget lorem dolor sed. Ut venenatis tellus in metus vulputate
                                    eu scelerisque.
                                </p>
                            </div>
                        </li> --}}
                    </ul>
                </div>
            </div>
        </section>
        <!-- End Frequently Asked Questions Section -->
    @endif

    <!-- ======= Konsultasi Section ======= -->
    <section id="konsultasi" class="konsultasi">
        <div class="container-academy" data-aos="fade-up">
            <div class="row">
                <div class="col-md-6 col-lg-6 order-1 order-md-2 order-lg-2" data-aos="fade-left" data-aos-delay="100">
                    <img src="{{ asset('front/assets/img/' . $konsultasi->thumbnail) }}" class="img-fluid"
                        alt="" />
                </div>
                <div class="col-md-6 col-lg-6 order-2 order-md-1 order-lg-1 content">
                    <h2>{{ $konsultasi->title }}</h2>
                    <div class="konsultasi-content">
                        <p>{{ $konsultasi->short_description }}</p>
                        <a class="btn btn-register" target="_blank" href="{{ $konsultasi->subtitle }}">Hubungi Kami</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- End Konsultasi Section -->
@endsection
