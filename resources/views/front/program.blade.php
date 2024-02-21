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
    <meta name="author" content="{{ Auth::user()->name }}">
    <meta property="og:url" content="{{ request()->fullUrl() }}" />
    <meta property="og:site_name" content="Phincon Academy" />
@endpush
@section('content')
    <!-- ======= Breadcrumbs ======= -->
    <div class="breadcrumbs">
        <div class="container-academy">
            <ol>
                <li>Home</li>
                <li>Program</li>
            </ol>
        </div>
    </div>
    <!-- End Breadcrumbs -->

    <!-- ======= Program Section ======= -->
    <section id="program" class="program">
        <div class="container-academy" data-aos="fade-up">
            <div class="row">
                @foreach ($program as $pr)
                    @php
                        $bg_image = \App\Models\Asset::where('content_id', $pr->id)
                            ->where('keterangan', 'background_image')
                            ->first();
                    @endphp
                    <div class="col-12 col-lg-6">
                        <div class="program-card courses-cards mb-3">
                            <h1 class="titles-courses">[{{ $pr->title }}] {{ $pr->subtitle }}</h1>
                            <h4 class="desc-courses">{{ $pr->short_description }}</h4>
                            <img src="{{ asset('front/assets/img/' . $bg_image->thumbnail) }}" style="border-radius: 20px"
                                class="img-fluid" alt="" />
                            <div class="points">
                                @if (!empty($pr->informasi_detail))
                                    @php
                                        $informasi = explode(',', $pr->informasi_detail);
                                    @endphp
                                @endif

                                <div class="row">
                                    @for ($i = 0; $i < count($informasi); $i++)
                                        @php
                                            $info = \App\Models\Informasi::find($informasi[$i]);
                                        @endphp
                                        <div class="col-12 col-sm-6 col-lg-6 mb-2">
                                            <div class="point d-inline-block"></div>
                                            {{ $info->title }}
                                        </div>
                                    @endfor
                                </div>
                            </div>
                            <div class="proficiencies">
                                @if (!empty($pr->category_detail))
                                    @php
                                        $category = explode(',', $pr->category_detail);
                                    @endphp
                                @endif
                                <div class="row">
                                    @for ($i = 0; $i < count($category); $i++)
                                        @php
                                            $cat = \App\Models\Informasi::find($category[$i]);
                                        @endphp
                                        <div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-2">
                                            <div class="proficiency d-inline-block"></div>
                                            {{ $cat->title }}
                                        </div>
                                    @endfor
                                </div>
                            </div>
                            <div class="program-course-selection">
                                <h3 class="mb-3">Pilihan Course</h3>
                                @php
                                    $courses = \App\Models\Content::where('parent_content_id', $pr->id)->get();
                                @endphp
                                @foreach ($courses as $c)
                                    <a class="btn btn-course mb-3"
                                        href="{{ route('coursedetails', $c->slug) }}">{{ $c->title }}</a>
                                @endforeach
                                {{-- <button class="btn btn-course mb-3">Android Kotlin Bootcamp</button> --}}
                                {{-- <button class="btn btn-course mb-3">Fullstack Javascript Bootcamp</button> --}}
                                <p>*Klik pada course untuk detail course</p>
                            </div>
                        </div>
                    </div>
                @endforeach

                {{-- <div class="col-12 col-lg-6">
                    <div class="program-card courses-cards">
                        <h1 class="titles-courses">[Online] Part-Time Bootcamp</h1>
                        <h4 class="desc-courses">
                            Buat kamu yang gak punya waktu banyak, bisa tetap upskilling
                            dengan pembelajaran secara asynchronous di Phincon Academy
                            bersama para expert selama 2 bulan
                        </h4>
                        <img src="{{ asset('front/assets/img/program-2.png') }}" class="img-fluid" alt="" />
                        <div class="points">
                            <div class="row">
                                <div class="col-12 col-sm-6 col-lg-6 mb-2">
                                    <div class="point d-inline-block"></div>
                                    Online
                                </div>
                                <div class="col-12 col-sm-6 col-lg-6 mb-2">
                                    <div class="point d-inline-block"></div>
                                    2-3 Month (12 Weeks)
                                </div>
                                <div class="col-12 col-sm-6 col-lg-6 mb-2">
                                    <div class="point d-inline-block"></div>
                                    3 Hours / Session
                                </div>
                                <div class="col-12 col-sm-6 col-lg-6 mb-2">
                                    <div class="point d-inline-block"></div>
                                    2-3 class/weeks ; 7PM - 10 PM
                                </div>
                                <div class="col-12 col-sm-6 col-lg-6 mb-2">
                                    <div class="point d-inline-block"></div>
                                    Student able to
                                </div>
                            </div>
                        </div>
                        <div class="proficiencies">
                            <div class="row">
                                <div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-2">
                                    <div class="proficiency d-inline-block"></div>
                                    Remembering
                                </div>
                                <div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-2">
                                    <div class="proficiency d-inline-block"></div>
                                    Understanding
                                </div>
                                <div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-2">
                                    <div class="proficiency d-inline-block"></div>
                                    Applying
                                </div>
                                <div class="col-12 col-sm-6 col-md-6 col-lg-4 mb-2">
                                    <div class="proficiency d-inline-block"></div>
                                    Analyzing
                                </div>
                            </div>
                        </div>
                        <div class="program-course-selection">
                            <h3 class="mb-3">Pilihan Course</h3>
                            <button class="btn btn-course mb-3">Part-Time IOS Bootcamp</button>
                            <button class="btn btn-course mb-3"> Part-Time Android Bootcamp</button>
                            <button class="btn btn-course mb-3">Part-Time Javascript Bootcamp</button>
                            <p>*Klik pada course untuk detail course</p>
                        </div>
                    </div>
                </div> --}}
            </div>
        </div>
    </section>
    <!-- End Popular Courses Section -->
@endsection
