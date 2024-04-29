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

    <!-- Header Start -->
    <div class="container-fluid bg-breadcrumb">
        <div class="container text-center py-5" style="max-width: 900px;">
            <h3 class="text-white display-3 mb-4 wow fadeInDown" data-wow-delay="0.1s">Our Services</h1>
                <ol class="breadcrumb justify-content-center mb-0 wow fadeInDown" data-wow-delay="0.3s">
                    <li class="breadcrumb-item"><a href="{{ route('index') }}">Home</a></li>
                    <li class="breadcrumb-item"><a href="#">Pages</a></li>
                    <li class="breadcrumb-item active text-primary">Services</li>
                </ol>
        </div>
    </div>
    <!-- Header End -->

    <!-- Services Start -->
    <div class="container-fluid service py-5">
        <div class="container py-5">
            <div class="section-title mb-5 wow fadeInUp" data-wow-delay="0.2s">
                <div class="sub-style">
                    <h4 class="sub-title px-3 mb-0">{{ $bidang_praktik_parent->title }}</h4>
                </div>
                <h1 class="display-3 mb-4">{{ $bidang_praktik_parent->subtitle }}</h1>
                <p class="mb-0">{{ $bidang_praktik_parent->short_description }}</p>
            </div>
            <div class="row g-4">
                @php
                    $count = 0.1;
                @endphp
                @foreach ($bidang_praktik_parent->childcontent as $bidang)
                    <div class="col-md-6 col-lg-4 col-xl-3 wow fadeInUp" data-wow-delay="{{ $count }}s">
                        <div class="service-item rounded">
                            <div class="service-img rounded-top">
                                {!! isset($bidang->asset->thumbnail)
                                    ? '<img class="img-fluid rounded-top" src="' . asset('frontend/assets/img/' . $bidang->asset->thumbnail) . '">'
                                    : '<img class="img-fluid rounded-top" src="' . asset('frontend/assets/img/law-icon.png') . '">' !!}
                            </div>
                            <div class="service-content rounded-bottom bg-light p-4">
                                <div class="service-content-inner">
                                    <a href="{{ route('detailAreaPraktek', $bidang->slug) }}" target="_blank">
                                        <h5 class="mb-4">{{ $bidang->title }}</h5>
                                    </a>
                                    <p class="mb-4">
                                        {{ $bidang->short_description }}
                                    </p>
                                    <a href="{{ route('detailAreaPraktek', $bidang->slug) }}" target="_blank"
                                        class="btn btn-primary rounded-pill text-white py-2 px-4 mb-2">Read
                                        More</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    @php
                        $count = $count + 0.2;
                    @endphp
                @endforeach
            </div>
        </div>
    </div>
    <!-- Services End -->


    <!-- Feature Start -->
    <div class="container-fluid feature py-5">
        <div class="container py-5">
            <div class="section-title mb-5 wow fadeInUp" data-wow-delay="0.1s">
                <div class="sub-style">
                    <h4 class="sub-title px-3 mb-0">{{ $mengapa_memilih_kami->title }}</h4>
                </div>
                <h1 class="display-3 mb-4">
                    {{ $mengapa_memilih_kami->subtitle }}
                </h1>
                <p class="mb-0">
                    {{ $mengapa_memilih_kami->short_description }}
                </p>
            </div>
            <div class="row g-4 justify-content-center">

                @php
                    $count = 0.1;
                @endphp

                @foreach ($mengapa_memilih_kami->childcontent as $key => $why)
                    <div class="col-md-6 col-lg-4 col-xl-3 wow fadeInUp" data-wow-delay="{{ $count }}s">
                        <div class="row-cols-1 feature-item p-4">
                            <div class="col-12">
                                <div class="feature-content d-flex flex-column">
                                    <h5 class="mb-4">{{ $why->title }}</h5>
                                    <p class="mb-0">
                                        {{ $why->short_description }}
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                    @php
                        $count = $count + 0.2;
                    @endphp
                @endforeach
            </div>
        </div>
    </div>
    <!-- Feature End -->

    <!-- Testimonial Start -->
    {{-- <div class="container-fluid testimonial py-5 wow zoomInDown" data-wow-delay="0.1s">
        <div class="container py-5">
            <div class="section-title mb-5">
                <div class="sub-style">
                    <h4 class="sub-title text-white px-3 mb-0">Testimonial</h4>
                </div>
                <h1 class="display-3 mb-4">What Clients are Say</h1>
            </div>
            <div class="testimonial-carousel owl-carousel">
                <div class="testimonial-item">
                    <div class="testimonial-inner p-5">
                        <div class="testimonial-inner-img mb-4">
                            <img src="img/testimonial-img.jpg" class="img-fluid rounded-circle" alt="">
                        </div>
                        <p class="text-white fs-7">Lorem ipsum dolor, sit amet consectetur adipisicing elit. Asperiores
                            nemo facilis tempora esse explicabo sed! Dignissimos quia ullam pariatur blanditiis sed
                            voluptatum. Totam aut quidem laudantium tempora. Minima, saepe earum!
                        </p>
                        <div class="text-center">
                            <h5 class="mb-2">John Abraham</h5>
                            <p class="mb-2 text-white-50">New York, USA</p>
                            <div class="d-flex justify-content-center">
                                <i class="fas fa-star text-secondary"></i>
                                <i class="fas fa-star text-secondary"></i>
                                <i class="fas fa-star text-secondary"></i>
                                <i class="fas fa-star text-secondary"></i>
                                <i class="fas fa-star text-secondary"></i>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="testimonial-item">
                    <div class="testimonial-inner p-5">
                        <div class="testimonial-inner-img mb-4">
                            <img src="img/testimonial-img.jpg" class="img-fluid rounded-circle" alt="">
                        </div>
                        <p class="text-white fs-7">Lorem ipsum dolor, sit amet consectetur adipisicing elit. Asperiores
                            nemo facilis tempora esse explicabo sed! Dignissimos quia ullam pariatur blanditiis sed
                            voluptatum. Totam aut quidem laudantium tempora. Minima, saepe earum!
                        </p>
                        <div class="text-center">
                            <h5 class="mb-2">John Abraham</h5>
                            <p class="mb-2 text-white-50">New York, USA</p>
                            <div class="d-flex justify-content-center">
                                <i class="fas fa-star text-secondary"></i>
                                <i class="fas fa-star text-secondary"></i>
                                <i class="fas fa-star text-secondary"></i>
                                <i class="fas fa-star text-secondary"></i>
                                <i class="fas fa-star text-secondary"></i>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="testimonial-item">
                    <div class="testimonial-inner p-5">
                        <div class="testimonial-inner-img mb-4">
                            <img src="img/testimonial-img.jpg" class="img-fluid rounded-circle" alt="">
                        </div>
                        <p class="text-white fs-7">Lorem ipsum dolor, sit amet consectetur adipisicing elit. Asperiores
                            nemo facilis tempora esse explicabo sed! Dignissimos quia ullam pariatur blanditiis sed
                            voluptatum. Totam aut quidem laudantium tempora. Minima, saepe earum!
                        </p>
                        <div class="text-center">
                            <h5 class="mb-2">John Abraham</h5>
                            <p class="mb-2 text-white-50">New York, USA</p>
                            <div class="d-flex justify-content-center">
                                <i class="fas fa-star text-secondary"></i>
                                <i class="fas fa-star text-secondary"></i>
                                <i class="fas fa-star text-secondary"></i>
                                <i class="fas fa-star text-secondary"></i>
                                <i class="fas fa-star text-secondary"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div> --}}
    <!-- Testimonial End -->

    <!-- Book Appointment Start -->
    <div class="container-fluid appointment py-5">
        <div class="container py-5">
            <div class="row g-5 align-items-center">
                <div class="col-lg-6 wow fadeInLeft" data-wow-delay="0.2">
                    <div class="section-title text-start">
                        <h1 class="mb-4">
                            {{ $call_to_action->title }}
                        </h1>
                        <div class="row g-4">
                            <div class="col-sm-6">
                                <div class="d-flex flex-column h-100">
                                    <div class="text-start mb-4">
                                        <a href="https://wa.me/{{ $content->no_wa }}" target="_blank"
                                            class="btn btn-primary rounded-pill text-white py-3 px-5">Hubungi Kami</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 wow fadeInRight" data-wow-delay="0.4s">
                    <div class="appointment-form rounded p-5">
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
@endsection
