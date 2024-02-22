@extends('layouts.app_front')
@push('meta')
    <meta name="description" content="{{ $artikel->short_description }}!" />
    <link rel="canonical" href="{{ route('index') . '/' . request()->segment(1) }}">
    <meta property="og:type" content="{{ request()->segment(1) }}" />
    <meta property="og:title" content="{{ $artikel->title . ' ' . $artikel->subtitle }}" />
    <meta property="og:description" content="{{ $artikel->short_description }}" />
    <meta property="article:published_time" content="{{ $artikel->created_at }}">
    <meta property="article:modified_time" content="{{ $artikel->updated_at }}">
    <meta name="author" content="{{ $artikel->created_by }}">
    <meta property="og:url" content="{{ request()->fullUrl() }}" />
    <meta property="og:site_name" content="Phincon Academy" />
@endpush

@section('content')
    <!-- ======= Breadcrumbs ======= -->
    <div class="breadcrumbs">
        <div class="container-academy">
            <ol>
                <li>Home</li>
                <li>Article</li>
                <li>{{ $artikel->title . ' ' . $artikel->subtitle }}</li>
            </ol>
        </div>
    </div>
    <!-- End Breadcrumbs -->

    @php
        $background_image = \App\Models\Asset::where('content_id', $artikel->id)
            ->where('keterangan', 'background_image')
            ->limit(1)
            ->first();
    @endphp
    <!-- ======= Article Details Section ======= -->
    <section id="article-detail" class="article-detail">
        <div class="container-academy" data-aos="fade-up">
            <div class="article-detail-img img-fluid mb-2"
                style="background-image: url('{{ asset('front/assets/img/' . $background_image->thumbnail) }}'); 
                background-repeat: no-repeat;
                background-size: cover;
                background-position: unset;
                border-radius: 20px;
                height: 550px;">
                <h2 class="text-white head-title-article">{{ $artikel->title }}
                    <i class="ms-2 mb-0 my-auto bi bi-arrow-right-circle"></i>
                </h2>
                <p class="text-white desc-title-article">{{ $artikel->subtitle }}</p>
            </div>
            <p class="mb-3" style="font-size: 14px; letter-spacing: .3px;"> Wednesday,
                {{ date('d-m-Y', strtotime('created_ats')) }}</p>
            {!! $artikel->content !!}

        </div>
    </section>
    <!-- End Article Details Section -->

    <!-- ======= Other Article Section ======= -->
    <section id="other-article" class="other-article">
        <div class="container-academy">
            <h1>Artikel Lain</h1>
            <div class="other-article-slider swiper" data-aos="fade-up" data-aos-delay="100">
                <div class="swiper-wrapper">
                    @foreach ($other_article as $art)
                        @php
                            $thumbnail = \App\Models\Asset::where('content_id', $art->id)
                                ->where('keterangan', 'thumbnail')
                                ->limit(1)
                                ->first();
                        @endphp
                        <div class="swiper-slide">
                            <div class="other-article-item">
                                <div class="other-article-body">
                                    <a href="{{ route('article-details', $art->slug) }}"><img
                                            src="{{ asset('front/assets/img/' . $thumbnail->thumbnail) }}"
                                            class="other-article-img" alt="" /></a>
                                </div>
                            </div>
                        </div>
                        <!-- End testimonial item -->
                    @endforeach
                </div>
                <div class="swiper-button-prev"></div>
                <div class="swiper-button-next"></div>
            </div>
        </div>
    </section>
    <!-- End Other Article Section -->
@endsection
