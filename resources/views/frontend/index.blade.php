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

    <section id="hero" class="hero">



        <div id="hero-carousel" class="carousel slide" data-bs-ride="carousel" data-bs-interval="5000">
            @php
                $bannerId = $banner[0]->id;
            @endphp
            @foreach ($banner as $key => $ban)
                <div class="carousel-item {{ $bannerId == $ban->id ? 'active' : '' }}">
                    <img class="w-100 h-100 object-fit-cover" src="{{ asset('frontend/assets/img/' . $ban->thumbnail) }}"
                        alt="Image" />
                    <div class="info d-flex align-items-center">
                        <div class="container">

                            <div class="row justify-content-center">
                                <div class="col-lg text-center">
                                    <h2 data-aos="fade-up" class="text-white"> {{ $ban->subtitle }}</h2>
                                    <h3 data-aos="fade-up" class="text-warning text-md"> {{ $ban->title }}</h3>
                                    <p data-aos="fade-up" class="text-white"> {{ $ban->short_description }}</p>

                                    <a data-aos="fade-up" data-aos-delay="200" href="https://wa.me/{{ $content->no_wa }}"
                                        target="_blank" class="btn-get-started">Konsultasi Sekarang</a>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>


                <a class="carousel-control-prev" href="#hero-carousel" role="button" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon bi bi-chevron-left" aria-hidden="true"></span>
                </a>

                <a class="carousel-control-next" href="#hero-carousel" role="button" data-bs-slide="next">
                    <span class="carousel-control-next-icon bi bi-chevron-right" aria-hidden="true"></span>
                </a>
            @endforeach
        </div>

    </section><!-- End Hero Section -->

    <main id="main">

        <!-- ======= Get Started Section ======= -->
        <section id="get-started" class="get-started section-bg">
            <div class="container">

                <div class="row justify-content-between gy-4">

                    <div class="col-lg-6 d-flex align-items-center" data-aos="fade-up">
                        <div class="content">
                            <h3>{{ $call_to_action->title }}</h3>
                            <a href="https://wa.me/{{ $content->no_wa }}" target="_blank"
                                class="btn btn-outline-warning rounded  py-3 px-5">Hubungi Kami</a>

                        </div>
                    </div>

                    <div class="col-lg-5" data-aos="fade">
                        <form action="{{ route('pengunjung-website.store') }}" method="post" class="php-email-form">
                            {{ csrf_field() }}
                            <h3>Atur Janji Temu Konsultasi</h3>
                            <p>Vel nobis odio laboriosam et hic voluptatem. Inventore vitae totam. Rerum repellendus enim
                                linead sero
                                park flows.</p>
                            <div class="row gy-3">

                                <div class="col-md-12">
                                    <input type="text" name="nama_pengunjung"
                                        class="form-control @error('nama_pengunjung') is-invalid @enderror"
                                        placeholder="Nama Anda" required>
                                    @error('nama_pengunjung')
                                        <small class="invalid-feedback">
                                            <strong>{{ $message }}</strong>
                                        </small>
                                    @enderror
                                </div>

                                <div class="col-md-12 ">
                                    <input type="email" class="form-control @error('email') is-invalid @enderror"
                                        name="email" placeholder="Email" required>
                                    @error('email')
                                        <small class="invalid-feedback">
                                            <strong>{{ $message }}</strong>
                                        </small>
                                    @enderror
                                </div>

                                <div class="col-md-12">
                                    <input type="text" class="form-control @error('no_wa') is-invalid @enderror"
                                        name="no_wa" placeholder="No. WhatsApp / No. HP yang bisa Dihubungi" required>
                                    @error('no_wa')
                                        <small class="invalid-feedback">
                                            <strong>{{ $message }}</strong>
                                        </small>
                                    @enderror
                                </div>

                                <div class="col-md-12">
                                    <div class="form-group">
                                        <div class="date" id="date" data-target-input="nearest">
                                            <input type="date" name="tanggal_janji_temu"
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
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <div class="time" id="time" data-target-input="nearest">
                                            <input type="time" name="waktu_janji_temu"
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
                                <div class="col-md-12">
                                    <textarea class="form-control  @error('topik_janji_temu') is-invalid @enderror" name="topik_janji_temu"
                                        rows="6" placeholder="Saya ingin berkonsultasi tentang . . ." required></textarea>
                                    @error('topik_janji_temu')
                                        <small class="invalid-feedback">
                                            <strong>{{ $message }}</strong>
                                        </small>
                                    @enderror
                                </div>


                                <div class="col-md-12 text-center">
                                    <div class="loading">Loading</div>
                                    <div class="error-message"></div>
                                    <div class="sent-message">Your message has been sent successfully. Thank you!
                                    </div>

                                    <button type="submit">Atur Janji Temu</button>
                                </div>

                            </div>
                        </form>
                    </div><!-- End Quote Form -->

                </div>

            </div>
        </section><!-- End Get Started Section -->

        <!-- ======= Tim kami Section ======= -->
        <section id="constructions" class="constructions">
            <div class="container" data-aos="fade-up">

                <div class="section-header">
                    <h2>{{ $lawyer->title }}</h2>
                    <h4 class="display-6 mb-4">
                        {{ $lawyer->subtitle }}
                    </h4>
                    <p>{{ $lawyer->short_description }}</p>
                </div>

                <div class="row gy-4">

                    @php
                        $count = 0.1;
                    @endphp
                    @foreach ($lawyer->childlawyer as $key => $law)
                        @php
                            $short_description = json_decode($law->short_description, true);
                        @endphp
                        <div class="col-lg-6" data-aos="fade-up" data-aos-delay="100">
                            <div class="card-item">
                                <div class="row">
                                    <div class="col-xl-5">
                                        <div class="card-bg" style="">
                                            {!! isset($law->asset->thumbnail)
                                                ? '<img class="img-fluid rounded-top w-100" alt="" src="' .
                                                    asset('frontend/assets/img/' . $law->asset->thumbnail) .
                                                    '">'
                                                : '<img class="img-fluid rounded-top w-100" alt="" src="' . asset('frontend/assets/img/lawyer-icon.jpeg') . '">' !!}
                                            <img class="img-fluid" src="img/team-1.jpg" alt="" />
                                        </div>
                                    </div>
                                    <div class="col-xl-7 d-flex align-items-center">
                                        <div class="card-body">
                                            <h4 class="card-title">{{ $law->title }}</h4>
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
                            </div>
                        </div><!-- End Card Item -->
                        @php
                            $count = $count + 0.2;
                        @endphp
                    @endforeach
                    <div class="col-12 text-center wow fadeInUp" data-wow-delay="{{ $count + 0.2 }}s">
                        <a class="btn btn-outline-warning rounded-pill text-black py-3 px-5"
                            href="{{ route('tim-kami') }}">Lihat
                            Seluruh Tim Kami</a>
                    </div>
                </div>
            </div>
        </section><!-- End tim kami Section -->

        <!-- ======= Services Section ======= -->
        <section id="services" class="services section-bg">
            <div class="container" data-aos="fade-up">

                <div class="section-header">
                    <h2>{{ $bidang_praktik_parent->title }}</h2>
                    <h5 class="display-3 mb-4">
                        {{ $bidang_praktik_parent->subtitle }}
                    </h5>
                    <p>{{ $bidang_praktik_parent->short_description }}</p>
                </div>

                <div class="row gy-4">
                    @php
                        $count = 0.1;
                    @endphp
                    @foreach ($bidang_praktik_parent->childareapraktek as $bidang)
                        <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="100">
                            <div class="service-item  position-relative">
                                <div class="">
                                    {!! isset($bidang->asset->thumbnail)
                                        ? '<img class="img-fluid" src="' . asset('frontend/assets/img/' . $bidang->asset->thumbnail) . '">'
                                        : '<img class="img-fluid" src="' . asset('frontend/assets/img/law-icon.png') . '">' !!}
                                    <img class="img-fluid" src="img/icon/icon-10-light.png" alt="" />
                                </div>
                                <h3> <a href="{{ route('detailAreaPraktek', $bidang->slug) }}" target="_blank">
                                        <h5 class="mb-0">{{ $bidang->title }}</h5>
                                    </a></h3>
                                <p> {{ $bidang->short_description }}</p>
                                <a href="{{ route('detailAreaPraktek', $bidang->slug) }}" target="_blank"
                                    class="readmore stretched-link">Read More <i class="bi bi-arrow-right"></i></a>
                            </div>
                        </div>
                    @endforeach
                    <!-- End Service Item -->
                </div>

            </div>
        </section><!-- End Services Section -->

        <!-- ======= Alt Services Section ======= -->
        <section id="alt-services" class="alt-services">
            <div class="container" data-aos="fade-up">
                <h3 class="text-center">{{ $mengapa_memilih_kami->title }}</h3>

                <div class="row justify-content-around gy-4">
                    {{-- <div class="col-lg-6 img-bg" style="background-image: url(assets/img/alt-services.jpg);"
                        data-aos="zoom-in" data-aos-delay="100"></div> --}}

                    <div class="col-lg d-flex flex-column justify-content-center">

                        <h3 class="text-start"> {{ $mengapa_memilih_kami->subtitle }}</h3>
                        <p class="text-start"> {{ $mengapa_memilih_kami->short_description }}</p>

                        @php
                            $count = 0.1;
                        @endphp
                        <div class="row">

                            @foreach ($mengapa_memilih_kami->childcontent as $key => $why)
                                <div class="icon-box d-flex position-relative col-md-6" data-aos="fade-up"
                                    data-aos-delay="100">
                                    <i class="bi bi-droplet flex-shrink-0"></i>
                                    <div>
                                        <h4><a href="" class="stretched-link">{{ $why->title }}</a></h4>
                                        <p>{{ $why->short_description }}</p>
                                    </div>
                                </div>
                                @php
                                    $count = $count + 0.2;
                                @endphp
                            @endforeach
                        </div>
                        <!-- End Icon Box -->
                    </div>
                </div>

            </div>
        </section><!-- End Alt Services Section -->

        <!-- Facts Start -->
        <div class="container-fluid overflow-hidden my-5 px-lg-0 bg-warning py-5">
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

        {{-- <!-- ======= Testimonials Section ======= -->
        <section id="testimonials" class="testimonials section-bg">
            <div class="container" data-aos="fade-up">

                <div class="section-header">
                    <h2>Testimonials</h2>
                    <p>Quam sed id excepturi ccusantium dolorem ut quis dolores nisi llum nostrum enim velit qui ut et autem
                        uia
                        reprehenderit sunt deleniti</p>
                </div>

                <div class="slides-2 swiper">
                    <div class="swiper-wrapper">

                        <div class="swiper-slide">
                            <div class="testimonial-wrap">
                                <div class="testimonial-item">
                                    <img src="assets/img/testimonials/testimonials-1.jpg" class="testimonial-img"
                                        alt="">
                                    <h3>Saul Goodman</h3>
                                    <h4>Ceo &amp; Founder</h4>
                                    <div class="stars">
                                        <i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i
                                            class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i
                                            class="bi bi-star-fill"></i>
                                    </div>
                                    <p>
                                        <i class="bi bi-quote quote-icon-left"></i>
                                        Proin iaculis purus consequat sem cure digni ssim donec porttitora entum suscipit
                                        rhoncus.
                                        Accusantium quam, ultricies eget id, aliquam eget nibh et. Maecen aliquam, risus at
                                        semper.
                                        <i class="bi bi-quote quote-icon-right"></i>
                                    </p>
                                </div>
                            </div>
                        </div><!-- End testimonial item -->

                        <div class="swiper-slide">
                            <div class="testimonial-wrap">
                                <div class="testimonial-item">
                                    <img src="assets/img/testimonials/testimonials-2.jpg" class="testimonial-img"
                                        alt="">
                                    <h3>Sara Wilsson</h3>
                                    <h4>Designer</h4>
                                    <div class="stars">
                                        <i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i
                                            class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i
                                            class="bi bi-star-fill"></i>
                                    </div>
                                    <p>
                                        <i class="bi bi-quote quote-icon-left"></i>
                                        Export tempor illum tamen malis malis eram quae irure esse labore quem cillum quid
                                        cillum eram malis
                                        quorum velit fore eram velit sunt aliqua noster fugiat irure amet legam anim culpa.
                                        <i class="bi bi-quote quote-icon-right"></i>
                                    </p>
                                </div>
                            </div>
                        </div><!-- End testimonial item -->

                        <div class="swiper-slide">
                            <div class="testimonial-wrap">
                                <div class="testimonial-item">
                                    <img src="assets/img/testimonials/testimonials-3.jpg" class="testimonial-img"
                                        alt="">
                                    <h3>Jena Karlis</h3>
                                    <h4>Store Owner</h4>
                                    <div class="stars">
                                        <i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i
                                            class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i
                                            class="bi bi-star-fill"></i>
                                    </div>
                                    <p>
                                        <i class="bi bi-quote quote-icon-left"></i>
                                        Enim nisi quem export duis labore cillum quae magna enim sint quorum nulla quem
                                        veniam duis minim
                                        tempor labore quem eram duis noster aute amet eram fore quis sint minim.
                                        <i class="bi bi-quote quote-icon-right"></i>
                                    </p>
                                </div>
                            </div>
                        </div><!-- End testimonial item -->

                        <div class="swiper-slide">
                            <div class="testimonial-wrap">
                                <div class="testimonial-item">
                                    <img src="assets/img/testimonials/testimonials-4.jpg" class="testimonial-img"
                                        alt="">
                                    <h3>Matt Brandon</h3>
                                    <h4>Freelancer</h4>
                                    <div class="stars">
                                        <i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i
                                            class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i
                                            class="bi bi-star-fill"></i>
                                    </div>
                                    <p>
                                        <i class="bi bi-quote quote-icon-left"></i>
                                        Fugiat enim eram quae cillum dolore dolor amet nulla culpa multos export minim
                                        fugiat minim velit
                                        minim dolor enim duis veniam ipsum anim magna sunt elit fore quem dolore labore
                                        illum veniam.
                                        <i class="bi bi-quote quote-icon-right"></i>
                                    </p>
                                </div>
                            </div>
                        </div><!-- End testimonial item -->

                        <div class="swiper-slide">
                            <div class="testimonial-wrap">
                                <div class="testimonial-item">
                                    <img src="assets/img/testimonials/testimonials-5.jpg" class="testimonial-img"
                                        alt="">
                                    <h3>John Larson</h3>
                                    <h4>Entrepreneur</h4>
                                    <div class="stars">
                                        <i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i
                                            class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i
                                            class="bi bi-star-fill"></i>
                                    </div>
                                    <p>
                                        <i class="bi bi-quote quote-icon-left"></i>
                                        Quis quorum aliqua sint quem legam fore sunt eram irure aliqua veniam tempor noster
                                        veniam enim
                                        culpa labore duis sunt culpa nulla illum cillum fugiat legam esse veniam culpa fore
                                        nisi cillum
                                        quid.
                                        <i class="bi bi-quote quote-icon-right"></i>
                                    </p>
                                </div>
                            </div>
                        </div><!-- End testimonial item -->

                    </div>
                    <div class="swiper-pagination"></div>
                </div>

            </div>
        </section><!-- End Testimonials Section --> --}}

        <!-- ======= Recent Blog Posts Section ======= -->
        <section id="recent-blog-posts" class="recent-blog-posts">
            <div class="container" data-aos="fade-up"">



                <div class=" section-header">
                    <h2>{{ $artikel->title }}</h2>
                    <h3>{{ $artikel->subtitle }}</h3>
                    <p>{{ $artikel->short_description }}</p>
                </div>

                <div class="row gy-5">
                    @php
                        $count = 0.1;
                    @endphp

                    @foreach ($artikel->childartikel as $key => $art)
                        <div class="col-xl-4 col-md-6" data-aos="fade-up" data-aos-delay="{{ $count }}s">
                            <div class="post-item position-relative h-100">

                                <div class="post-img position-relative overflow-hidden">
                                    {!! isset($art->asset->thumbnail)
                                        ? '<img src="' .
                                            asset('frontend/assets/img/' . $art->asset->thumbnail) .
                                            '" class="img-fluid w-100" alt="' .
                                            $artikel->title .
                                            '">'
                                        : '<img class="img-fluid w-100" src="' . asset('frontend/assets/img/law-icon.jpeg') . '">' !!}
                                    <span class="post-date">{{ tanggal_lengkap($art->created_at, false) }}</span>
                                </div>

                                <div class="post-content d-flex flex-column justify-content-between">


                                    <a target="_blank" href="{{ route('article-details', $art->slug) }}"
                                        title="{{ $art->title }}">
                                        <h3 class="post-title">{{ substr($art->title, 0, 54) }}...</h3>
                                    </a>
                                    <p class="art-short-desc" class="my-4">
                                        {{ substr($art->short_description, 0, 100) }}</p>

                                    <div class="d-flex flex-column position-absolute bottom-0 mb-3">
                                        <a href="{{ route('article-details', $art->slug) }}" target="_blank"
                                            class="readmore stretched-link "><span>Read
                                                More</span><i class="bi bi-arrow-right"></i></a>

                                    </div>


                                </div>

                            </div>
                        </div><!-- End post item -->
                        @php
                            $count = $count + 0.2;
                        @endphp
                    @endforeach
                </div>

            </div>
        </section>
        <!-- End Recent Blog Posts Section -->

    </main><!-- End #main -->
@endsection
