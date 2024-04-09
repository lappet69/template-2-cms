@extends('layouts.app_frontend')

@push('meta')
    <meta name="description" content="" />
    <link rel="canonical" href="">
    <meta property="og:type" content="" />
    <meta property="og:title" content="" />
    <meta property="og:description" content="" />
    <meta property="article:published_time" content="">
    <meta property="article:modified_time" content="">
    <meta property="og:url" content="" />
    <meta property="og:site_name" content="Phincon Academy" />
@endpush
@push('css')
    <style>
        .bg-action {
            background: linear-gradient(rgba(55, 55, 63, 0.7), rgba(55, 55, 63, 0.7)),
                url('{{ asset('frontend/assets/img/' . $call_to_action->thumbnail) }}'), no-repeat center center;
            background-size: cover;
        }
    </style>
@endpush
@section('content')
    @php
        $identitas = \App\Models\Content::where('active', 1)->where('section_id', 1)->limit(1)->first();
        $content = json_decode($identitas->content);
    @endphp
    <!-- Carousel Start -->
    <div class="container-fluid p-0 mb-5 wow fadeIn" data-wow-delay="0.1s">
        <div id="header-carousel" class="carousel slide" data-bs-ride="carousel">
            @php
                $bannerId = $banner[0]->id;
            @endphp
            <div class="carousel-inner">
                @foreach ($banner as $key => $ban)
                    <div class="carousel-item  {{ $bannerId == $ban->id ? 'active' : '' }}">
                        <img class="w-100" src="{{ asset('frontend/assets/img/' . $ban->thumbnail) }}" alt="Image" />
                        <div class="carousel-caption">
                            <div class="container">
                                <div class="row">
                                    <div class="col-12 col-lg-6">
                                        <h4 class="display-6 text-primary mb-4 animated slideInDown">
                                            {{ $ban->subtitle }}
                                        </h4>
                                        <h5 class="display-3 text-capitalize text-white mb-4">
                                            {{ $ban->title }}
                                        </h5>
                                        <p class="fs-5 text-body mb-5">
                                            {{ $ban->short_description }}
                                        </p>
                                        <a href="" class="btn btn-primary py-3 px-5">More Details</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#header-carousel" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#header-carousel" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>
    </div>
    <!-- Carousel End -->

    <!-- About Start -->
    <div class="container-xxl py-5">
        <div class="container">
            <div class="row g-5">
                <div class="col-lg-6 wow fadeInUp" data-wow-delay="0.1s">
                    <div class="position-relative overflow-hidden rounded ps-5 pt-5 h-100" style="min-height: 400px">
                        <img class="position-absolute w-100 h-100" src="{{ asset('frontend/assets/img/about.jpg') }}"
                            alt="" style="object-fit: contain" />
                        <div class="position-absolute top-0 start-0 bg-white rounded pe-2 pb-2"
                            style="width: 150px; height: 130px">
                            <div class="d-flex flex-column justify-content-center text-center bg-primary rounded h-100 p-3">
                                <h1 class="text-white mb-0">25</h1>
                                <h2 class="text-white">Years</h2>
                                <h5 class="text-white mb-0">Experience</h5>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 wow fadeInUp" data-wow-delay="0.5s">
                    <div class="h-100">
                        <h3 class="display-6 mb-4">
                            {{ $about->title }}
                        </h3>
                        <h5 class="display-6 mb-5">
                            {{ $about->subtitle }}
                        </h5>
                        <p class="fs-5 text-primary mb-4">
                            {{ $about->short_description }}
                        </p>
                        {{-- <div class="row g-4 mb-4">
                            <div class="col-sm-6">
                                <div class="d-flex align-items-center">
                                    <img class="flex-shrink-0 me-3" src="img/icon/icon-04-primary.png" alt="" />
                                    <h5 class="mb-0">Flexible Insurance Plans</h5>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="d-flex align-items-center">
                                    <img class="flex-shrink-0 me-3" src="img/icon/icon-03-primary.png" alt="" />
                                    <h5 class="mb-0">Money Back Guarantee</h5>
                                </div>
                            </div>
                        </div>
                        <p class="mb-4">
                            Tempor erat elitr rebum at clita. Diam dolor diam ipsum sit.
                            Aliqu diam amet diam et eos. Clita erat ipsum et lorem et sit,
                            sed stet lorem sit clita duo justo magna dolore erat amet
                        </p> --}}
                        <div class="border-top mt-4 pt-4">
                            <div class="d-flex align-items-center">
                                <img class="flex-shrink-0 rounded-circle me-3" src="img/profile.jpg" alt="" />
                                <a href="{{ route('tentang-kami') }}"
                                    class="btn btn-primary rounded-pill text-white py-3 px-5">Selengkapnya..</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- About End -->

    <!-- Facts Start -->
    <div class="container-fluid overflow-hidden my-5 px-lg-0">
        <div class="container facts px-lg-0">
            <div class="row g-0 mx-lg-0">
                <div class="col-lg-6 facts-text wow fadeIn" data-wow-delay="0.1s">
                    <div class="h-100 px-4 ps-lg-0">
                        <h1 class="text-white mb-4">For Individuals And Organisations</h1>
                        <p class="text-light mb-5">
                            Tempor erat elitr rebum at clita. Diam dolor diam ipsum sit.
                            Aliqu diam amet diam et eos. Clita erat ipsum et lorem et sit,
                            sed stet lorem sit clita duo justo magna dolore erat amet
                        </p>
                        <a href="" class="align-self-start btn btn-secondary py-3 px-5">More Details</a>
                    </div>
                </div>
                <div class="col-lg-6 facts-counter wow fadeIn" data-wow-delay="0.5s">
                    <div class="h-100 px-4 pe-lg-0">
                        <div class="row g-5">
                            <div class="col-sm-6">
                                <h1 class="display-5" data-toggle="counter-up">1234</h1>
                                <p class="fs-5 text-primary">Happy Clients</p>
                            </div>
                            <div class="col-sm-6">
                                <h1 class="display-5" data-toggle="counter-up">1234</h1>
                                <p class="fs-5 text-primary">Projects Succeed</p>
                            </div>
                            <div class="col-sm-6">
                                <h1 class="display-5" data-toggle="counter-up">1234</h1>
                                <p class="fs-5 text-primary">Awards Achieved</p>
                            </div>
                            <div class="col-sm-6">
                                <h1 class="display-5" data-toggle="counter-up">1234</h1>
                                <p class="fs-5 text-primary">Team Members</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Facts End -->

    <!-- Features Start -->
    <div class="container-xxl py-5">
        <div class="container">
            <div class="row g-5">
                <div class="col-lg-6 wow fadeInUp" data-wow-delay="0.1s">
                    <h1 class="display-6 mb-5">{{ $mengapa_memilih_kami->title }}</h1>
                    <h1 class="display-6 mb-4">
                        {{ $mengapa_memilih_kami->subtitle }}
                    </h1>
                    <p class="mb-4">
                        {{ $mengapa_memilih_kami->short_description }}
                    </p>
                    <div class="row g-3">
                        @php
                            $count = 0.1;
                        @endphp
                        @foreach ($mengapa_memilih_kami->childcontent as $key => $why)
                            <div class="col-sm-6 wow fadeIn" data-wow-delay="0.1s">
                                <div class="bg-light rounded h-100 p-3">
                                    <div
                                        class="bg-white d-flex flex-column justify-content-center text-center rounded h-100 py-4 px-3">
                                        <img class="align-self-center mb-3" src="img/icon/icon-06-primary.png"
                                            alt="" />
                                        <h5 class="mb-0">{{ $why->title }}</h5>
                                        <p class="mb-0">
                                            {{ $why->short_description }}
                                        </p>
                                    </div>
                                </div>
                            </div>
                            @php
                                $count = $count + 0.2;
                            @endphp
                        @endforeach
                    </div>
                </div>
                <div class="col-lg-6 wow fadeInUp" data-wow-delay="0.5s">
                    <div class="position-relative rounded overflow-hidden h-100" style="min-height: 400px">
                        <img class="position-absolute w-100 h-100" src="img/feature.jpg" alt=""
                            style="object-fit: cover" />
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Features End -->

    <!-- Service Start -->
    <div class="container-xxl py-5">
        <div class="container">
            <div class="text-center mx-auto" style="max-width: 500px">
                <h1 class="display-6 mb-5">
                    {{ $bidang_praktik_parent->title }}
                </h1>
            </div>
            <div class="text-center">
                <h5 class="display-3 mb-4">
                    {{ $bidang_praktik_parent->subtitle }}
                </h5>
                <p class="mb-0">
                    {{ $bidang_praktik_parent->short_description }}
                </p>
            </div>
            <div class="row g-4 justify-content-center">
                @php
                    $count = 0.1;
                @endphp
                @foreach ($bidang_praktik_parent->childareapraktek as $bidang)
                    <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.1s">
                        <div class="service-item rounded h-100 p-5">
                            <div class="d-flex align-items-center ms-n5 mb-4">
                                <div class="service-icon flex-grow-0 bg-primary rounded-end me-4">
                                    {!! isset($bidang->asset->thumbnail)
                                        ? '<img class="img-fluid" src="' . asset('frontend/assets/img/' . $bidang->asset->thumbnail) . '">'
                                        : '<img class="img-fluid" src="' . asset('frontend/assets/img/law-icon.png') . '">' !!}
                                    <img class="img-fluid" src="img/icon/icon-10-light.png" alt="" />
                                </div>

                                <a href="{{ route('detailAreaPraktek', $bidang->slug) }}" target="_blank">
                                    <h5 class="mb-0">{{ $bidang->title }}</h5>
                                </a>
                            </div>
                            <p class="mb-4">
                                {{ $bidang->short_description }}
                            </p>
                            <a href="{{ route('detailAreaPraktek', $bidang->slug) }}" target="_blank"
                                class="btn btn-light px-3">Read
                                More</a>
                        </div>
                    </div>
                    @php
                        $count = $count + 0.2;
                    @endphp
                @endforeach
                <div class="col-12 text-center wow fadeInUp" data-wow-delay="{{ $count + 0.2 }}s">
                    <a class="btn btn-primary rounded-pill text-white py-3 px-5" href="{{ route('area-praktek') }}">Area
                        Praktek Lainnya</a>
                </div>
            </div>
        </div>
    </div>
    <!-- Service End -->

    <!-- Appointment Start -->
    <div class="container-fluid appointment my-5 py-5 wow fadeIn" data-wow-delay="0.1s">
        <div class="container py-5">
            <div class="row g-5">
                <div class="col-lg-6 wow fadeIn" data-wow-delay="0.3s">
                    <h1 class="display-6 text-white mb-5">
                        {{ $call_to_action->title }}
                    </h1>
                    {{-- <p class="text-white mb-5">
                        Aliqu diam amet diam et eos. Clita erat ipsum et lorem et sit, sed
                        stet lorem sit clita duo justo magna dolore erat amet. Tempor erat
                        elitr rebum at clita. Diam dolor diam ipsum sit. Aliqu diam amet
                        diam et eos. Clita erat ipsum et lorem et sit, sed stet lorem sit
                        clita duo justo magna.
                    </p> --}}
                    <div class="bg-white rounded p-3">
                        <a href="https://wa.me/{{ $content->no_wa }}" target="_blank"
                            class="btn btn-outline-primary rounded  py-3 px-5">Hubungi Kami</a>
                    </div>
                </div>
                <div class="col-lg-6 wow fadeIn" data-wow-delay="0.5s">
                    <div class="bg-white rounded p-5">
                        <h1 class="mb-4">Atur Janji Temu Konsultasi</h1>
                        <form action="{{ route('pengunjung-website.store') }}" method="POST">
                            {{ csrf_field() }}
                            <div class="row gy-3 gx-4">
                                <div class="col-xl-12">
                                    <input type="text" name="nama_pengunjung"
                                        class="form-control @error('nama_pengunjung') is-invalid @enderror py-3 border-primary bg-transparent text-white"
                                        placeholder="Nama Anda" />
                                    @error('nama_pengunjung')
                                        <small class="invalid-feedback">
                                            <strong>{{ $message }}</strong>
                                        </small>
                                    @enderror
                                </div>
                                <div class="col-xl-12">
                                    <input type="email" name="email"
                                        class="form-control @error('email') is-invalid @enderror py-3 border-primary bg-transparent text-white"
                                        placeholder="Email" />

                                    @error('email')
                                        <small class="invalid-feedback">
                                            <strong>{{ $message }}</strong>
                                        </small>
                                    @enderror
                                </div>
                                <div class="col-xl-12">
                                    <input type="phone" name="no_wa"
                                        class="form-control @error('no_wa') is-invalid @enderror py-3 border-primary bg-transparent"
                                        placeholder="No. WhatsApp / No. HP yang bisa Dihubungi" />
                                    @error('no_wa')
                                        <small class="invalid-feedback">
                                            <strong>{{ $message }}</strong>
                                        </small>
                                    @enderror
                                </div>
                                <div class="col-xl-6">
                                    <div class="form-group">
                                        <div class="date" id="date" data-target-input="nearest">
                                            <input type="text" name="tanggal_janji_temu"
                                                class="form-control @error('tanggal_janji_temu') is-invalid @enderror py-3 border-primary bg-transparent datetimepicker-input"
                                                placeholder="Pilih Tanggal" data-target="#date"
                                                data-toggle="datetimepicker" />
                                        </div>
                                        @error('tanggal_janji_temu')
                                            <small class="invalid-feedback">
                                                <strong>{{ $message }}</strong>
                                            </small>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-xl-6">
                                    <div class="form-group">
                                        <div class="time" id="time" data-target-input="nearest">
                                            <input type="text" name="waktu_janji_temu"
                                                class="form-control @error('waktu_janji_temu') is-invalid @enderror py-3 border-primary bg-transparent datetimepicker-input"
                                                placeholder="Pilih Waktu" data-target="#time"
                                                data-toggle="datetimepicker" />
                                        </div>
                                        @error('waktu_janji_temu')
                                            <small class="invalid-feedback">
                                                <strong>{{ $message }}</strong>
                                            </small>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-12">
                                    <textarea class="form-control @error('topik_janji_temu') is-invalid @enderror border-primary bg-transparent text-white"
                                        name="topik_janji_temu" id="" cols="30" rows="5"
                                        placeholder="Saya ingin berkonsultasi tentang . . ."></textarea>

                                    @error('topik_janji_temu')
                                        <small class="invalid-feedback">
                                            <strong>{{ $message }}</strong>
                                        </small>
                                    @enderror
                                </div>
                                <div class="col-12">
                                    <button type="submit" class="btn btn-primary text-white w-100 py-3 px-5">
                                        Atur Janji Temu
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Appointment End -->

    <!-- Team Start -->
    <div class="container-xxl py-5">
        <div class="container">
            <div class="text-center mx-auto" style="max-width: 500px">
                <h1 class="display-6 mb-5">{{ $lawyer->title }}</h1>
            </div>
            <div class="text-center">
                <h4 class="display-6 mb-4">
                    {{ $lawyer->subtitle }}
                </h4>
                <p class="mb-0">
                    {{ $lawyer->short_description }}
                </p>
            </div>
            <div class="row g-4">
                @php
                    $count = 0.1;
                @endphp
                @foreach ($lawyer->childlawyer as $key => $law)
                    @php
                        $short_description = json_decode($law->short_description, true);
                    @endphp
                    <div class="col-lg-3 col-md-6 wow fadeInUp" data-wow-delay="0.1s">
                        <div class="team-item rounded">
                            {!! isset($law->asset->thumbnail)
                                ? '<img class="img-fluid rounded-top w-100" alt="" src="' .
                                    asset('frontend/assets/img/' . $law->asset->thumbnail) .
                                    '">'
                                : '<img class="img-fluid rounded-top w-100" alt="" src="' . asset('frontend/assets/img/lawyer-icon.jpeg') . '">' !!}
                            <img class="img-fluid" src="img/team-1.jpg" alt="" />
                            <div class="text-center p-4">
                                <h5>{{ $law->title }}</h5>
                                <span>{{ $law->jabatan->name }}</span>
                            </div>
                            <div class="team-text text-center bg-white p-4">
                                <h5>{{ $law->title }}</h5>
                                <p>{{ $law->jabatan->name }}</p>
                                <div class="d-flex justify-content-center">
                                    <a class="btn btn-square btn-light m-1"
                                        href="{{ $short_description['media_sosial']['twitter'] }}"><i
                                            class="fab fa-twitter"></i></a>
                                    <a class="btn btn-square btn-light m-1"
                                        href="{{ $short_description['media_sosial']['facebook'] }}"><i
                                            class="fab fa-facebook-f"></i></a>
                                    <a class="btn btn-square btn-light m-1"
                                        href="{{ $short_description['media_sosial']['instagram'] }}"><i
                                            class="fab fa-instagram"></i></a>
                                    <a class="btn btn-square btn-light m-1"
                                        href="{{ $short_description['media_sosial']['linkedin'] }}"><i
                                            class="fab fa-linkedin-in"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                    @php
                        $count = $count + 0.2;
                    @endphp
                @endforeach
                <div class="col-12 text-center wow fadeInUp" data-wow-delay="{{ $count + 0.2 }}s">
                    <a class="btn btn-primary rounded-pill text-white py-3 px-5" href="{{ route('tim-kami') }}">Lihat
                        Seluruh Tim Kami</a>
                </div>
            </div>
        </div>
    </div>
    <!-- Team End -->

    <!-- Testimonial Start -->
    {{-- <div class="container-xxl py-5">
        <div class="container">
            <div class="text-center mx-auto" style="max-width: 500px">
                <h1 class="display-6 mb-5">What They Say About Our Insurance</h1>
            </div>
            <div class="row g-5">
                <div class="col-lg-3 d-none d-lg-block">
                    <div class="testimonial-left h-100">
                        <img class="img-fluid animated pulse infinite" src="img/testimonial-1.jpg" alt="" />
                        <img class="img-fluid animated pulse infinite" src="img/testimonial-2.jpg" alt="" />
                        <img class="img-fluid animated pulse infinite" src="img/testimonial-3.jpg" alt="" />
                    </div>
                </div>
                <div class="col-lg-6 wow fadeIn" data-wow-delay="0.5s">
                    <div class="owl-carousel testimonial-carousel">
                        <div class="testimonial-item text-center">
                            <img class="img-fluid rounded mx-auto mb-4" src="img/testimonial-1.jpg" alt="" />
                            <p class="fs-5">
                                Dolores sed duo clita tempor justo dolor et stet lorem kasd
                                labore dolore lorem ipsum. At lorem lorem magna ut et, nonumy
                                et labore et tempor diam tempor erat.
                            </p>
                            <h5>Client Name</h5>
                            <span>Profession</span>
                        </div>
                        <div class="testimonial-item text-center">
                            <img class="img-fluid rounded mx-auto mb-4" src="img/testimonial-2.jpg" alt="" />
                            <p class="fs-5">
                                Dolores sed duo clita tempor justo dolor et stet lorem kasd
                                labore dolore lorem ipsum. At lorem lorem magna ut et, nonumy
                                et labore et tempor diam tempor erat.
                            </p>
                            <h5>Client Name</h5>
                            <span>Profession</span>
                        </div>
                        <div class="testimonial-item text-center">
                            <img class="img-fluid rounded mx-auto mb-4" src="img/testimonial-3.jpg" alt="" />
                            <p class="fs-5">
                                Dolores sed duo clita tempor justo dolor et stet lorem kasd
                                labore dolore lorem ipsum. At lorem lorem magna ut et, nonumy
                                et labore et tempor diam tempor erat.
                            </p>
                            <h5>Client Name</h5>
                            <span>Profession</span>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 d-none d-lg-block">
                    <div class="testimonial-right h-100">
                        <img class="img-fluid animated pulse infinite" src="img/testimonial-1.jpg" alt="" />
                        <img class="img-fluid animated pulse infinite" src="img/testimonial-2.jpg" alt="" />
                        <img class="img-fluid animated pulse infinite" src="img/testimonial-3.jpg" alt="" />
                    </div>
                </div>
            </div>
        </div>
    </div> --}}
    <!-- Testimonial End -->
    <!-- Blog Start -->
    <div class="container-fluid blog py-5">
        <div class="container py-5">
            <div class="section-title mb-5 wow fadeInUp" data-wow-delay="0.1s">
                <div class="sub-style">
                    <h4 class="sub-title px-3 mb-0">{{ $artikel->title }}</h4>
                </div>
                <h1 class="display-3 mb-4">
                    {{ $artikel->subtitle }}
                </h1>
                <p class="mb-0">
                    {{ $artikel->short_description }}
                </p>
            </div>
            <div class="row g-4">
                @php
                    $count = 0.1;
                @endphp

                @foreach ($artikel->childartikel as $key => $art)
                    <div class="col-md-6 col-lg-6 col-xl-4 wow fadeInUp" data-wow-delay="{{ $count }}s">
                        <div class="blog-item rounded">
                            <div class="blog-img">
                                {!! isset($art->asset->thumbnail)
                                    ? '<img src="' .
                                        asset('frontend/assets/img/' . $art->asset->thumbnail) .
                                        '" class="img-fluid w-100" alt="' .
                                        $artikel->title .
                                        '">'
                                    : '<img class="img-fluid w-100" src="' . asset('frontend/assets/img/law-icon.jpeg') . '">' !!}
                            </div>
                            <div class="blog-centent p-4">
                                <div class="d-flex justify-content-between mb-4">
                                    <p class="mb-0 text-muted">
                                        <i class="fa fa-calendar-alt text-primary"></i>
                                        {{ tanggal_lengkap($art->created_at, false) }}
                                    </p>
                                </div>
                                <a target="_blank" href="{{ route('article-details', $art->slug) }}"
                                    class="art-title h4"
                                    title="{{ $art->title }}">{{ substr($art->title, 0, 54) }}...</a>
                                <p class="art-short-desc" class="my-4">{{ substr($art->short_description, 0, 100) }}
                                </p>
                                <a target="_blank" href="{{ route('article-details', $art->slug) }}"
                                    class="btn btn-primary rounded-pill text-white py-2 px-4 mb-1">Baca Selengkapnya >></a>
                            </div>
                        </div>
                    </div>
                    @php
                        $count = $count + 0.2;
                    @endphp
                @endforeach

                <div class="col-12 text-center wow fadeInUp" data-wow-delay="{{ $count + 0.2 }}s">
                    <a class="btn btn-primary rounded-pill text-white py-3 px-5"
                        href="{{ route('artikel-publikasi') }}">Lihat
                        Artikel Lainnya</a>
                </div>

            </div>
        </div>
    </div>
    <!-- Blog End -->
@endsection
