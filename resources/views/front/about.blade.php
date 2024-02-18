@extends('layouts.app_front')

@section('content')
    @php
        $identitas = \App\Models\Identitas::where('active', '1')->limit(1)->first();
    @endphp
    <!-- ======= Breadcrumbs ======= -->
    <div class="breadcrumbs">
        <div class="container-academy">
            <ol>
                <li>Home</li>
                <li>About Us</li>
            </ol>
        </div>
    </div>
    <!-- End Breadcrumbs -->
    <!-- ======= Hero Slider Section ======= -->
    <section id="hero" class="hero">
        <div class="container-fluid p-0" data-aos="fade-in">
            <img src="{{ asset('front/assets/img/' . $about->thumbnail) }}" style="" class="img-fluid" alt="" />
            {{-- <div class="img-bg d-flex align-items-end"
                style="background-image: url('{{ asset('front/assets/img/' . $about->thumbnail) }}');
                    background-size: cover;
                    background-repeat: no-repeat;">
                <div class="img-bg-inner">
                    <p>{{ $about->short_description }}</p>
                </div>
            </div> --}}
        </div>
    </section>
    <!-- End Hero Slider Section -->

    <!-- ======= Vision Section ======= -->
    <section id="vision" class="vision">
        <div class="container-academy" data-aos="fade-in">
            <div class="row">
                <div class="col-12">
                    <img src="{{ asset('front/assets/img/' . $vision->thumbnail) }}" style="border-radius:20px"
                        class="img-fluid" alt="" />
                </div>
            </div>
        </div>
    </section>
    <!-- End Vision Section -->

    <!-- ======= Mission Section ======= -->
    <section id="mission" class="mission">
        <div class="container-academy" data-aos="fade-in">
            <div class="row">
                <div class="col-12">
                    <img src="{{ asset('front/assets/img/' . $mission->thumbnail) }}" style="border-radius:20px"
                        class="img-fluid" alt="" />
                </div>
            </div>
        </div>
    </section>
    <!-- End Mission Section -->

    <!-- ======= Kilas Balik Section ======= -->
    <section id="kilas-balik" class="kilas-balik">
        <div class="container-academy" data-aos="fade-up">
            <div class="section-title">
                <h2>{{ $kilasbalik->title }}</h2>
            </div>

            <div class="row">
                <div class="col-12">
                    <p>{{ $kilasbalik->short_description }}</p>
                    <img src="{{ asset('front/assets/img/' . $kilasbalik->thumbnail) }}" class="img-fluid" alt="" />
                </div>
            </div>
        </div>
    </section>
    <!-- End Kilas Balik Section -->

    <!-- ======= Konsultasi Section ======= -->
    <section id="konsultasi" class="konsultasi">
        <div class="container-academy" data-aos="fade-up">
            <div class="row">
                <div class="col-md-6 col-lg-6 order-1 order-md-2 order-lg-2" data-aos="fade-left" data-aos-delay="100">
                    <img src="{{ asset('front/assets/img/' . $konsultasi->thumbnail) }}" class="img-fluid" alt="" />
                </div>
                <div class="col-md-6 col-lg-6 my-auto order-2 order-md-1 order-lg-1 content">
                    <h2>{{ $konsultasi->title }}</h2>
                    <div class="konsultasi-content">
                        <p>{{ $konsultasi->short_description }} </p>
                        <a class="btn btn-register" href="{{ $konsultasi->subtitle }}">Hubungi Kami</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- End Konsultasi Section -->
@endsection
