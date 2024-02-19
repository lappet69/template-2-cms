@extends('layouts.app_front')

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
            <div class="article-detail-img mb-5">
                <img src="{{ asset('front/assets/img/' . $background_image->thumbnail) }}" style="border-radius: 20px;"
                    class="img-fluid h-auto" alt="" />
            </div>
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
