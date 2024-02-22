@extends('layouts.app_front')
@php
    $identitas = \App\Models\Identitas::where('active', '1')->limit(1)->first();
@endphp
@push('meta')
    <meta name="description" content="{{ $identitas->short_description }}" />
    <link rel="canonical" href="{{ route('index') . '/' . request()->segment(1) }}">
    <meta property="og:type" content="{{ !empty(request()->segment(1)) ? request()->segment(1) : 'home' }}" />
    <meta property="og:title" content="{{ $identitas->nama_website }}" />
    <meta property="og:description" content="{{ $identitas->short_description }}" />
    <meta property="article:published_time" content="{{ $identitas->created_at }}">
    <meta property="article:modified_time" content="{{ $identitas->updated_at }}">
    <meta property="og:url" content="{{ request()->fullUrl() }}" />
    <meta property="og:site_name" content="Phincon Academy" />
@endpush
@section('content')


    <!-- ======= Hero Slider Section ======= -->
    <div class="container-academy">
        @if (count($banner) > 1)
            <section id="hero-slider" class="swiper swiper-banner">
                <div class="swiper-wrapper" data-aos="fade-in">
                    @foreach ($banner as $slider)
                        <div class="swiper-slide">
                            <img src="{{ asset('front/assets/img/' . $slider->thumbnail) }}" class="img-fluid"
                                alt="" style="border-radius: 20px" />
                        </div>
                    @endforeach
                </div>
                <div class="swiper-pagination"></div>
                {{-- <div class="swiper-button-prev"></div> --}}
                {{-- <div class="swiper-button-next"></div> --}}
            </section>
        @else
            <section id="hero-slider" class="hero-slider">
                <div class="container-academy" data-aos="fade-in">
                    <div class="hero-slider-card">
                        <img src="{{ asset('front/assets/img/' . $banner[0]->thumbnail) }}" class="img-fluid"
                            alt="" />
                    </div>
                </div>
            </section>
        @endif
    </div>

    <!-- End Hero Slider Section -->

    <!-- ======= Article Slider Section ======= -->
    <section id="article-slider" class="article-slider">
        <div class="container-academy" data-aos="fade-in">
            <div class="row">
                @foreach ($articles as $art)
                    @php
                        $thumbnail = \App\Models\Asset::where('content_id', $art->id)
                            ->where('keterangan', 'thumbnail')
                            ->first();
                    @endphp

                    <div class="col-12 col-sm-6 col-lg-3 mb-lg-0 mb-3">
                        <a href="{{ route('article-details', $art->slug) }}">
                            <img src="{{ asset('front/assets/img/' . $thumbnail->thumbnail) }}"
                                class="img-bg-article w-100" style="border-radius: 15px;">
                            <div class="img-bg-article-inner img-pos-thumb">
                                <h4 class="text-white title-home-article-thumb">{{ $art->title }} <i
                                        class="ms-2 mb-0 my-auto bi bi-arrow-right-circle"></i><br>&nbsp;</h4>
                                <p class="text-white desc-home-article-thumb">{{ $art->subtitle }}</p>
                            </div>
                        </a>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
    <!-- End Article Slider Section -->

    <!-- ======= Courses Section ======= -->
    <section id="popular-courses" class="courses">
        <div class="container-academy" data-aos="fade-up">
            <div class="section-title">
                <h2>Program</h2>
            </div>

            <div class="row">
                @foreach ($program as $p)
                    @php
                        $thumbnail = \App\Models\Asset::where('content_id', $p->id)
                            ->where('keterangan', 'thumbnail')
                            ->first();
                    @endphp

                    <div class="col-12 col-md-6 col-lg-6">
                        <a href="javascript:void(0)" class="img-bg-course d-flex align-items-end"
                            style="
                                background-image: url('{{ asset('front/assets/img/' . $thumbnail->thumbnail) }}');
                                background-size: cover;
                                background-repeat: no-repeat;
                                background-position: center center;
                                padding: 15px;">
                            <div class="img-bg-course-inner">
                                <h3><span class="kategori">{{ $p->title }}</span> {{ $p->subtitle }}</h3>
                                <p class="desc-academy">{{ $p->short_description }}</p>
                                <div class="row mt-4">
                                    @php
                                        $courses = \App\Models\Content::where('parent_content_id', $p->id)->get();
                                    @endphp
                                    @foreach ($courses as $c)
                                        <div class="col-12 col-lg-4 mb-3">
                                            <button onclick="window.location.href='{{ route('coursedetails', $c->slug) }}'"
                                                class="btn btn-outline-academy">
                                                {{ $c->title }}
                                            </button>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </a>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
    <!-- End Courses Section -->

    <!-- ======= Why Section ======= -->
    <section id="why" class="why">
        <div class="container-academy" data-aos="fade-up">
            <div class="section-title">
                <h2>Kenapa Memilih Bootcamp<br>di Phincon Academy</h2>
            </div>

            <div class="row">
                @foreach ($why_bootcamp_phincon as $why)
                    @php
                        $thumbnail = \App\Models\Asset::where('content_id', $why->id)
                            ->where('keterangan', 'thumbnail')
                            ->first();
                    @endphp
                    <div class="col-12 col-sm-6 col-lg-4 mb-3">
                        <a href="javascript:void(0)">
                            <img src="{{ asset('front/assets/img/' . $thumbnail->thumbnail) }}" alt=""
                                class="img-bg-why d-flex align-items-end w-100">
                            <div class="img-bg-why-inner">
                                <h3 class="title-why mb-3">{{ $why->title }}</h3>
                                <p class="desc-why">{{ $why->short_description }}</p>
                            </div>
                        </a>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
    <!-- End Why Section -->

    <!-- ======= Clients Section ======= -->
    <section id="clients" class="clients section-bg">
        <div class="container-academy" data-aos="zoom-in">
            <div class="section-title">
                <h2 class="text-center">Our Client</h2>
            </div>
            <div class="row">
                @foreach ($clients as $cl)
                    <div class="col-6 col-sm-6 col-md-4 col-lg-2 mb-5">
                        <div class="text-center">
                            <img src="{{ asset('front/assets/img/' . $cl->thumbnail) }}"
                                class="img-fluid w-75 img-home-client" alt="" />
                        </div>
                    </div>
                @endforeach
            </div>
            <div id="myDIV" style="display:none;">
                <div class="row">
                    @foreach ($more_client as $item)
                        <div class="col-6 col-sm-6 col-md-4 col-lg-2 mb-5">
                            <div class="text-center">
                                <img src="{{ asset('front/assets/img/' . $item->thumbnail) }}"
                                    class="img-fluid w-75 img-home-client" alt="" />
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
            <div class="text-center"><button class="more-clients" onclick="myFunction()">See More Clients</button></div>
        </div>
    </section>
    <!-- End Clients Section -->

    <!-- ======= Testimonials Section ======= -->
    <section id="testimonials" class="testimonials">
        <div class="container-academy">
            <div class="section-title">
                <h2>Testimony</h2>
            </div>

            <div class="testimonials-slider swiper" data-aos="fade-up" data-aos-delay="100">
                <div class="swiper-wrapper">
                    @foreach ($testimonies as $testi)
                        <div class="swiper-slide">
                            <div class="testimonial-item">
                                <div class="testimonial-content">
                                    <img src="{{ asset('front/assets/img/' . $testi->thumbnail) }}"
                                        class="testimonial-img" alt="" />
                                    <p>{{ $testi->short_description }}</p>
                                    <div class="testimonial-profile">
                                        <h3>{{ $testi->title }}</h3>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- End testimonial item -->
                    @endforeach
                    <!-- End testimonial item -->
                </div>
                <div class="swiper-button-prev" id="prev-arrow-testi"></div>
                <div class="swiper-button-next" id="next-arrow-testi"></div>
            </div>
        </div>
    </section>
    <!-- End Testimonials Section -->

    <!-- ======= About Section ======= -->
    {{-- <section id="about" class="about">
        <div class="container-academy" data-aos="fade-up">
            <div class="row">
                <div class="col-lg-6 order-1 order-lg-2" data-aos="fade-left" data-aos-delay="100">
                    <img src="{{ asset('front/assets/img/beasiswa-program-bg.png') }}" alt="" />
                </div>
                <div class="col-lg-6 order-2 order-lg-1 content">
                    <h1 class="mb-4">Program Beasiswa</h1>
                    <div class="beasiswa row">
                        <div class="col-12 col-sm-6 col-lg-4">
                            <a class="text-center" href="">IOS Swift Bootcamp
                                <hr />
                            </a>
                        </div>
                        <div class="col-12 col-sm-6 col-lg-4">
                            <a class="text-center" href="">Android Kotlin Bootcamp
                                <hr />
                            </a>
                        </div>
                        <div class="col-12 col-sm-6 col-lg-4">
                            <a class="text-center" href="">Fullstack Javascript Bootcamp
                                <hr />
                            </a>
                        </div>
                    </div>

                    <div class="beasiswa-content">
                        <p>
                            Bagi kamu yang menginginkan kesempatan beasiswa penuh untuk
                            mengembangkan passion serta kemampuan dalam bidang teknologi,
                            Phincon Academy memberikan peluang beasiswa sebagai langkah
                            meraih karir gemilang di masa depan
                        </p>
                        <h5>Bootcamp dengan beasiswa full 100%</h5>
                        <a class="btn btn-register">Daftar</a>
                    </div>
                </div>
            </div>
        </div>
    </section> --}}
    <!-- End About Section -->

    <!-- ======= Call To Action Section ======= -->
    {{-- <section id="cta" class="cta section-blue-bg">
        <div class="container-academy" data-aos="fade-up">
            <div class="section-title">
                <h2 class="text-center text-white mb-3">Beberapa Promo Menarik dari Kami</h2>
            </div>
            <div class="swiper swiper-promo">
                <div class="swiper-wrapper">
                    @foreach ($promos as $pr)
                        <div class="swiper-slide">
                            <div class="text-center bg-promo">
                                <img src="{{ asset('front/assets/img/' . $pr->thumbnail) }}" height="100%"
                                    width="100%" alt="">
                            </div>
                        </div>
                    @endforeach
                </div>
                <div class="swiper-pagination"></div>
                <div class="swiper-button-prev" id="prev-arrow-promo"></div>
                <div class="swiper-button-next" id="next-arrow-promo"></div>
            </div>
        </div>
    </section> --}}
    <!-- End Call To Action Section -->

    <!-- ======= Value Section ======= -->
    {{-- <section id="value" class="value section-grey-bg">
        <div class="container-academy">
            <div class="row counters">
                <div class="col-lg-3 col-6 text-center value-list">
                    <img class="img-fluid mb-3" src="{{ asset('front/assets/img/icon_teacher.svg') }}" alt="" />
                    <p>Intensive interactive learning & mentoring</p>
                </div>

                <div class="col-lg-3 col-6 text-center value-list">
                    <img class="img-fluid mb-3" src="{{ asset('front/assets/img/icon_learning_with_a_book.png') }}"
                        alt="" />
                    <p>Soft skill guidance</p>
                </div>

                <div class="col-lg-3 col-6 text-center value-list">
                    <img class="img-fluid mb-3" src="{{ asset('front/assets/img/icon_computer_training.png') }}"
                        alt="" />
                    <p>Andragogy concept learning</p>
                </div>

                <div class="col-lg-3 col-6 text-center value-list">
                    <img class="img-fluid mb-3" src="{{ asset('front/assets/img/icon_medal.png') }}" alt="" />
                    <p>Project based-learning</p>
                </div>
            </div>
        </div>
    </section> --}}
    <!-- End Value Section -->

    <!-- ======= Campus Section ======= -->
    <section id="campus" class="campus">
        <div class="container-academy" data-aos="fade-up">
            <div class="section-title">
                <h2>Kampus</h2>
            </div>
            <div class="row">
                <div class="col-12 col-md-6 col-lg-6 content" data-aos="fade-left" data-aos-delay="100">
                    <h4 class="mb-3">{{ $identitas->nama_gedung }}</h4>
                    <p>{{ $identitas->alamat_kantor }}</p>
                    <div class="row mt-4">
                        <div class="col-lg-6 col-12 d-flex mb-3 mb-lg-0">
                            <i class="bi bi-envelope"></i>
                            <span>
                                <p class="campus label">Email</p>
                                <p class="campus-input"><a class="campus-input"
                                        href="mailto:{{ $identitas->email }}">{{ $identitas->email }}</a></p>
                            </span>
                        </div>
                        <div class="col-lg-6 col-12 d-flex mb-3 mb-lg-0">
                            <i class="bi bi-telephone-fill"></i>
                            <span>
                                <p class="campus label">Phone</p>
                                <p class="campus-input">
                                    <a class="campus-input"
                                        href="tel:{{ $identitas->no_telp }}">{{ $identitas->no_telp }}</a>
                                </p>
                            </span>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-6 col-lg-6">
                    <img src="{{ asset('front/assets/img/' . $identitas->img_address_1) }}" class="img-fluid campus1" />
                </div>
            </div>
            <div class="row mt-4">
                <div class="col-12 col-md-6 col-lg-6">
                    <img src="{{ asset('front/assets/img/' . $identitas->img_address_2) }}" class="img-fluid campus2" />
                </div>
                <div class="ccol-12 col-md-6 col-lg-6">
                    <img src="{{ asset('front/assets/img/' . $identitas->img_address_3) }}" class="img-fluid campus3" />
                </div>
            </div>
        </div>
    </section>
    <!-- End Campus Section -->

    <!-- ======= What They Say Section ======= -->
    {{-- <section id="what-they-say" class="what-they-say">
        <div class="container-academy" data-aos="fade-up">
            <div class="section-title">
                <h2>Kata Mereka</h2>
            </div>
            <div class="row">
                <div class="col-12 col-md-12 col-lg-4 content" data-aos="fade-left" data-aos-delay="100">
                    <h2>Mentor</h2>
                    <div class="mentor-content">
                        <p>
                            Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed
                            diam nonumy eirmod tempor invidunt ut labore et dolore magna
                            aliquyam erat, sed diam voluptua. At vero eos et accusam et
                            justo duo dolores et ea
                        </p>
                    </div>
                </div>
                <div class="col-12 col-md-12 col-lg-8">
                    <div class="what-they-say-slider swiper" data-aos="fade-up" data-aos-delay="100">
                        <div class="swiper-wrapper">
                            <div class="swiper-slide">
                                <div class="what-they-say-item">
                                    <div class="what-they-say-content">
                                        <img src="{{ asset('front/assets/img/testimonials/testimonials-1.jpg') }}"
                                            class="what-they-say-img" alt="" />
                                        <div class="what-they-say-profile">
                                            <div class="what-they-say-title">
                                                <p>
                                                    <span class="title-label">Nama</span> Yolanda
                                                    Faulyn
                                                </p>
                                                <p>
                                                    <span class="title-label">Specialty</span> Front
                                                    End Developer
                                                </p>
                                                <p>
                                                    <span class="title-label">Title</span> Sarjana
                                                    Komputer
                                                </p>
                                                <p><span class="title-label">Exp</span> 8 Tahun</p>
                                                <p>
                                                    Lorem ipsum dolor sit amet, consetetur sadipscing
                                                    elitr, sed diam nonumy eirmod tempor invidunt ut
                                                    labore et dolore magna aliquyam erat, sed diam
                                                    voluptua. At vero eos et accusam et justo duo
                                                    dolores et ea rebum. Stet clita kasd gubergren, no
                                                    sea takimata sanctus est Lorem ipsum dolor sit
                                                    amet. Lorem ipsum dolor sit amet, consetetur
                                                    sadipscing elitr, sed diam nonumy eirmod tempor
                                                    invidunt ut labore et dolore magna aliquyam erat,
                                                    sed diam voluptua. At vero eos et accusam et justo
                                                    duo dolores et ea rebum. Stet clita kasd
                                                    gubergren, no sea takimata sanctus est Lorem ipsum
                                                    dolor sit amet. Lorem ipsum dolor sit amet,
                                                    consetetur sadipscing elitr, sed diam nonumy
                                                    eirmod tempor invidunt ut labore et dolore magna
                                                    aliquyam erat, sed diam voluptua. At vero eos et
                                                    accusam et justo duo dolores et ea rebum. Stet
                                                    clita kasd gubergren, no sea takimata sanctus est
                                                    Lorem ipsum dolor sit amet. Lorem ipsum dolor sit
                                                    amet, consetetur sadipscing elitr, sed diam nonumy
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- End testimonial item -->

                            <div class="swiper-slide">
                                <div class="what-they-say-item">
                                    <div class="what-they-say-content">
                                        <img src="{{ asset('front/assets/img/testimonials/testimonials-2.jpg') }}"
                                            class="what-they-say-img" alt="" />
                                        <div class="what-they-say-profile">
                                            <div class="what-they-say-title">
                                                <p class="">
                                                    <span class="title-label">Nama</span> Yolanda
                                                    Faulyn
                                                </p>
                                                <p class="">
                                                    <span class="title-label">Specialty</span> Front
                                                    End Developer
                                                </p>
                                                <p>
                                                    <span class="title-label">Title</span> Sarjana
                                                    Komputer
                                                </p>
                                                <p><span class="title-label">Exp</span> 8 Tahun</p>
                                                <p>
                                                    Lorem ipsum dolor sit amet, consetetur sadipscing
                                                    elitr, sed diam nonumy eirmod tempor invidunt ut
                                                    labore et dolore magna aliquyam erat, sed diam
                                                    voluptua. At vero eos et accusam et justo duo
                                                    dolores et ea rebum. Stet clita kasd gubergren, no
                                                    sea takimata sanctus est Lorem ipsum dolor sit
                                                    amet. Lorem ipsum dolor sit amet, consetetur
                                                    sadipscing elitr, sed diam nonumy eirmod tempor
                                                    invidunt ut labore et dolore magna aliquyam erat,
                                                    sed diam voluptua. At vero eos et accusam et justo
                                                    duo dolores et ea rebum. Stet clita kasd
                                                    gubergren, no sea takimata sanctus est Lorem ipsum
                                                    dolor sit amet. Lorem ipsum dolor sit amet,
                                                    consetetur sadipscing elitr, sed diam nonumy
                                                    eirmod tempor invidunt ut labore et dolore magna
                                                    aliquyam erat, sed diam voluptua. At vero eos et
                                                    accusam et justo duo dolores et ea rebum. Stet
                                                    clita kasd gubergren, no sea takimata sanctus est
                                                    Lorem ipsum dolor sit amet. Lorem ipsum dolor sit
                                                    amet, consetetur sadipscing elitr, sed diam nonumy
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- End testimonial item -->

                            <div class="swiper-slide">
                                <div class="what-they-say-item">
                                    <div class="what-they-say-content">
                                        <img src="{{ asset('front/assets/img/testimonials/testimonials-3.jpg') }}"
                                            class="what-they-say-img" alt="" />
                                        <div class="what-they-say-profile">
                                            <div class="what-they-say-title">
                                                <p class="">
                                                    <span class="title-label">Nama</span> Yolanda
                                                    Faulyn
                                                </p>
                                                <p class="">
                                                    <span class="title-label">Specialty</span> Front
                                                    End Developer
                                                </p>
                                                <p>
                                                    <span class="title-label">Title</span> Sarjana
                                                    Komputer
                                                </p>
                                                <p><span class="title-label">Exp</span> 8 Tahun</p>
                                                <p>
                                                    Lorem ipsum dolor sit amet, consetetur sadipscing
                                                    elitr, sed diam nonumy eirmod tempor invidunt ut
                                                    labore et dolore magna aliquyam erat, sed diam
                                                    voluptua. At vero eos et accusam et justo duo
                                                    dolores et ea rebum. Stet clita kasd gubergren, no
                                                    sea takimata sanctus est Lorem ipsum dolor sit
                                                    amet. Lorem ipsum dolor sit amet, consetetur
                                                    sadipscing elitr, sed diam nonumy eirmod tempor
                                                    invidunt ut labore et dolore magna aliquyam erat,
                                                    sed diam voluptua. At vero eos et accusam et justo
                                                    duo dolores et ea rebum. Stet clita kasd
                                                    gubergren, no sea takimata sanctus est Lorem ipsum
                                                    dolor sit amet. Lorem ipsum dolor sit amet,
                                                    consetetur sadipscing elitr, sed diam nonumy
                                                    eirmod tempor invidunt ut labore et dolore magna
                                                    aliquyam erat, sed diam voluptua. At vero eos et
                                                    accusam et justo duo dolores et ea rebum. Stet
                                                    clita kasd gubergren, no sea takimata sanctus est
                                                    Lorem ipsum dolor sit amet. Lorem ipsum dolor sit
                                                    amet, consetetur sadipscing elitr, sed diam nonumy
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- End testimonial item -->

                            <div class="swiper-slide">
                                <div class="what-they-say-item">
                                    <div class="what-they-say-content">
                                        <img src="{{ asset('front/assets/img/testimonials/testimonials-4.jpg') }}"
                                            class="what-they-say-img" alt="" />
                                        <div class="what-they-say-profile">
                                            <div class="what-they-say-title">
                                                <p class="">
                                                    <span class="title-label">Nama</span> Yolanda
                                                    Faulyn
                                                </p>
                                                <p class="">
                                                    <span class="title-label">Specialty</span> Front
                                                    End Developer
                                                </p>
                                                <p>
                                                    <span class="title-label">Title</span> Sarjana
                                                    Komputer
                                                </p>
                                                <p><span class="title-label">Exp</span> 8 Tahun</p>
                                                <p>
                                                    Lorem ipsum dolor sit amet, consetetur sadipscing
                                                    elitr, sed diam nonumy eirmod tempor invidunt ut
                                                    labore et dolore magna aliquyam erat, sed diam
                                                    voluptua. At vero eos et accusam et justo duo
                                                    dolores et ea rebum. Stet clita kasd gubergren, no
                                                    sea takimata sanctus est Lorem ipsum dolor sit
                                                    amet. Lorem ipsum dolor sit amet, consetetur
                                                    sadipscing elitr, sed diam nonumy eirmod tempor
                                                    invidunt ut labore et dolore magna aliquyam erat,
                                                    sed diam voluptua. At vero eos et accusam et justo
                                                    duo dolores et ea rebum. Stet clita kasd
                                                    gubergren, no sea takimata sanctus est Lorem ipsum
                                                    dolor sit amet. Lorem ipsum dolor sit amet,
                                                    consetetur sadipscing elitr, sed diam nonumy
                                                    eirmod tempor invidunt ut labore et dolore magna
                                                    aliquyam erat, sed diam voluptua. At vero eos et
                                                    accusam et justo duo dolores et ea rebum. Stet
                                                    clita kasd gubergren, no sea takimata sanctus est
                                                    Lorem ipsum dolor sit amet. Lorem ipsum dolor sit
                                                    amet, consetetur sadipscing elitr, sed diam nonumy
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- End testimonial item -->

                            <div class="swiper-slide">
                                <div class="what-they-say-item">
                                    <div class="what-they-say-content">
                                        <img src="{{ asset('front/assets/img/testimonials/testimonials-5.jpg') }}"
                                            class="what-they-say-img" alt="" />
                                        <div class="what-they-say-profile">
                                            <div class="what-they-say-title">
                                                <p class="">
                                                    <span class="title-label">Nama</span> Yolanda
                                                    Faulyn
                                                </p>
                                                <p class="">
                                                    <span class="title-label">Specialty</span> Front
                                                    End Developer
                                                </p>
                                                <p>
                                                    <span class="title-label">Title</span> Sarjana
                                                    Komputer
                                                </p>
                                                <p><span class="title-label">Exp</span> 8 Tahun</p>
                                                <p>
                                                    Lorem ipsum dolor sit amet, consetetur sadipscing
                                                    elitr, sed diam nonumy eirmod tempor invidunt ut
                                                    labore et dolore magna aliquyam erat, sed diam
                                                    voluptua. At vero eos et accusam et justo duo
                                                    dolores et ea rebum. Stet clita kasd gubergren, no
                                                    sea takimata sanctus est Lorem ipsum dolor sit
                                                    amet. Lorem ipsum dolor sit amet, consetetur
                                                    sadipscing elitr, sed diam nonumy eirmod tempor
                                                    invidunt ut labore et dolore magna aliquyam erat,
                                                    sed diam voluptua. At vero eos et accusam et justo
                                                    duo dolores et ea rebum. Stet clita kasd
                                                    gubergren, no sea takimata sanctus est Lorem ipsum
                                                    dolor sit amet. Lorem ipsum dolor sit amet,
                                                    consetetur sadipscing elitr, sed diam nonumy
                                                    eirmod tempor invidunt ut labore et dolore magna
                                                    aliquyam erat, sed diam voluptua. At vero eos et
                                                    accusam et justo duo dolores et ea rebum. Stet
                                                    clita kasd gubergren, no sea takimata sanctus est
                                                    Lorem ipsum dolor sit amet. Lorem ipsum dolor sit
                                                    amet, consetetur sadipscing elitr, sed diam nonumy
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- End testimonial item -->
                        </div>
                        <div class="swiper-button-prev"></div>
                        <div class="swiper-button-next"></div>
                    </div>
                </div>
            </div>
        </div>
    </section> --}}
    <!-- End What They Say Section -->

    <!-- ======= Alumni Section ======= -->
    {{-- <section id="alumni" class="alumni">
        <div class="container-academy" data-aos="fade-up">
            <div class="section-title">
                <h2>Alumni</h2>
            </div>

            <div class="row">
                <div class="col-12 col-md-6 col-lg-4 d-flex justify-content-center">
                    <div class="alumni-card img-bg-alumni d-flex justify-content-end"
                        style="
          background-image: url('{{ asset('front/assets/img/alumni-bg.png') }}');
          background-size: cover;
          background-repeat: no-repeat;
          background-position: center center;
        ">
                        <div class="img-bg-alumni-inner">
                            <p class="mb-3">
                                Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed
                                diam nonumy eirmod tempor invidunt ut labore et dolore magna
                                aliquyam erat, sed diam voluptua. At vero eos et
                            </p>
                            <h6>Phincon Academy Bacth 3 (2023)</h6>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-6 col-lg-4 d-flex justify-content-center">
                    <div class="alumni-card img-bg-alumni d-flex justify-content-end"
                        style="
          background-image: url('{{ asset('front/assets/img/alumni-bg.png') }}');
          background-size: cover;
          background-repeat: no-repeat;
          background-position: center center;
        ">
                        <div class="img-bg-alumni-inner">
                            <p class="mb-3">
                                Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed
                                diam nonumy eirmod tempor invidunt ut labore et dolore magna
                                aliquyam erat, sed diam voluptua. At vero eos et
                            </p>
                            <h6>Phincon Academy Bacth 3 (2023)</h6>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-6 col-lg-4 d-flex justify-content-center">
                    <div class="alumni-card img-bg-alumni d-flex justify-content-end"
                        style="
          background-image: url('{{ asset('front/assets/img/alumni-bg.png') }}');
          background-size: cover;
          background-repeat: no-repeat;
          background-position: center center;
        ">
                        <div class="img-bg-alumni-inner">
                            <p class="mb-3">
                                Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed
                                diam nonumy eirmod tempor invidunt ut labore et dolore magna
                                aliquyam erat, sed diam voluptua. At vero eos et
                            </p>
                            <h6>Phincon Academy Bacth 3 (2023)</h6>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section> --}}
    <!-- End Alumni Section -->

    <!-- ======= Konsultasi Section ======= -->
    <section id="konsultasi" class="konsultasi">
        <div class="container-academy" data-aos="fade-up">
            <div class="row">
                <div class="col-md-6 col-lg-6 order-1 order-md-2 order-lg-2" data-aos="fade-left" data-aos-delay="100">
                    <img src="{{ asset('front/assets/img/' . $konsultasi->thumbnail) }}" class="img-fluid"
                        alt="" />
                </div>
                <div class="col-md-6 col-lg-6 order-2 order-md-1 order-lg-1 content my-auto">
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
@push('scripts')
    <script>
        function myFunction() {
            var x = document.getElementById("myDIV");
            if (x.style.display === "none") {
                x.style.display = "block";
            } else {
                x.style.display = "none";
            }
        }
    </script>
@endpush
