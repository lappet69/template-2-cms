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
@php
    $asset_area_praktek = isset($area_praktek->asset->thumbnail) ? $area_praktek->asset->thumbnail : 'law-icon.png';
@endphp
@push('css')
    <style>
        .elementor-widget-container {
            padding: 52px 40px 55px 40px;
            background-color: #000347;
            background-image: url(https://lhplegal.com/wp-content/uploads/2021/08/lhp-activity.jpg);
            background-position: top center;
            background-repeat: no-repeat;
            background-size: cover;
        }

        .bg-action {
            background: linear-gradient(rgba(55, 55, 63, 0.7), rgba(55, 55, 63, 0.7)),
                url('{{ asset('frontend/assets/img/' . $call_to_action->thumbnail) }}'), no-repeat center center;
            background-size: cover;
        }

        .bg-page-header {
            background: linear-gradient(rgba(55, 55, 63, 0.7), rgba(55, 55, 63, 0.7)),
                url('{{ asset('frontend/assets/img/' . $asset_area_praktek) }}'), no-repeat center center;
            background-size: cover;
        }

        .post:not(.post-single-content) {
            margin-bottom: 20px;
        }

        .entry-title {
            margin: 0;
            font-size: 14px;
            line-height: 1rem;
            position: relative;
            float: left;
            width: 100%;
        }

        .post-title {
            color: #b49c73;
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
            <h3 class="text-white display-3 mb-4 wow fadeInDown" data-wow-delay="0.1s">{{ $area_praktek->title }}</h1>
                <ol class="breadcrumb justify-content-center mb-0 wow fadeInDown" data-wow-delay="0.3s">
                    <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                    <li class="breadcrumb-item"><a href="#">Pages</a></li>
                    <li class="breadcrumb-item active text-primary">{{ $area_praktek->title }}</li>
                </ol>
        </div>
    </div>
    <!-- Header End -->

    <div class="container-fluid py-5">
        <div class="container py-5">
            <div class="row g-4">
                <div class="col-lg-8">
                    <div class="mb-4">
                        <a href="#" class="h1 display-5">{{ $area_praktek->title }}</a>
                    </div>
                    <div class="position-relative rounded overflow-hidden mb-3">
                        {!! isset($area_praktek->asset->thumbnail)
                            ? '<img src="' .
                                asset('frontend/assets/img/' . $area_praktek->asset->thumbnail) .
                                '" class="img-zoomin img-fluid rounded w-100" alt="' .
                                $area_praktek->title .
                                '">'
                            : '' !!}
                    </div>
                    {!! $area_praktek->content !!}
                </div>
                <div class="col-lg-4">
                    <div class="row g-4">
                        <div class="col-12">
                            <div class="p-3 rounded border">
                                <h4 class="mb-4">{{ $area_praktik_parent->title }}</h4>
                                <div class="row g-2">
                                    @foreach ($area_praktik_parent->childcontent as $key => $item)
                                        <div class="col-12">
                                            <a href="{{ route('detailAreaPraktek', $item->slug) }}"
                                                class="link-hover btn btn-light w-100 rounded text-uppercase text-dark py-3">{{ $item->title }}</a>
                                        </div>
                                    @endforeach
                                </div>
                                <h4 class="my-4">Terhubung dengan Kami</h4>
                                <div class="row g-4">
                                    <div class="col-12">
                                        <a href="{{ $content->facebook }}" target="_blank"
                                            class="w-100 rounded btn btn-primary d-flex align-items-center p-3 mb-2">
                                            <i class="fab fa-facebook-f btn btn-light btn-square rounded-circle me-3"></i>
                                            <span class="text-white">Ikuti Facebook Kami</span>
                                        </a>
                                        <a href="{{ $content->twitter }}" target="_blank"
                                            class="w-100 rounded btn btn-danger d-flex align-items-center p-3 mb-2">
                                            <i class="fab fa-twitter btn btn-light btn-square rounded-circle me-3"></i>
                                            <span class="text-white">Ikuti Twitter Kami</span>
                                        </a>
                                        <a href="{{ $content->youtube }}" target="_blank"
                                            class="w-100 rounded btn btn-warning d-flex align-items-center p-3 mb-2">
                                            <i class="fab fa-youtube btn btn-light btn-square rounded-circle me-3"></i>
                                            <span class="text-white">Subsribe Youtube Kami</span>
                                        </a>
                                        <a href="{{ $content->instagram }}" target="_blank"
                                            class="w-100 rounded btn btn-dark d-flex align-items-center p-3 mb-2">
                                            <i class="fab fa-instagram btn btn-light btn-square rounded-circle me-3"></i>
                                            <span class="text-white">Ikuti Instagram Kami</span>
                                        </a>
                                        <a href="{{ $content->linkedin }}" target="_blank"
                                            class="w-100 rounded btn btn-warning d-flex align-items-center p-3 mb-4">
                                            <i class="fab fa-linkedin btn btn-light btn-square rounded-circle me-3"></i>
                                            <span class="text-white">Ikuti Linkedin Kami</span>
                                        </a>
                                    </div>
                                </div>
                                <h4 class="my-4">Konsultasikan Sekarang</h4>
                                <div class="elementor-widget-container">
                                    <div class="gva-element-gva-heading-block gva-element">
                                        <div class="align-left style-1 widget gsc-heading">
                                            <div class="content-inner">
                                                <h2 class="title">
                                                    <span>Konsultasikan Sekarang</span>
                                                </h2>
                                                <div class="title-desc"> dengan<br /> Penasihat Hukum Berkualitas</div>

                                                <div class="heading-action">
                                                    <a href="https://wa.me/{{ $content->no_wa }}"
                                                        class="link-hover btn btn-light">
                                                        <span>Hubungi Kami</span>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Single Product End -->
@endsection
