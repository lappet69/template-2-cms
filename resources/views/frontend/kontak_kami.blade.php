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
    @php
        $short_description = json_decode($kontak_kami->short_description);
    @endphp

    <!-- Header Start -->
    <div class="container-fluid bg-breadcrumb">
        <div class="container text-center py-5" style="max-width: 900px;">
            <h3 class="text-white display-3 mb-4 wow fadeInDown" data-wow-delay="0.1s">Hubungi Kami</h1>
                <ol class="breadcrumb justify-content-center mb-0 wow fadeInDown" data-wow-delay="0.3s">
                    <li class="breadcrumb-item"><a href="{{ route('index') }}">Home</a></li>
                    <li class="breadcrumb-item active text-primary">Hubungi Kami</li>
                </ol>
        </div>
    </div>

    <!-- Contact Start -->
    <div class="container-fluid contact py-5">
        <div class="container py-5">
            <div class="section-title mb-5 wow fadeInUp" data-wow-delay="0.1s">
                <div class="sub-style mb-4">
                    <h4 class="sub-title text-white px-3 mb-0">{{ $kontak_kami->title }}</h4>
                </div>
                <p class="mb-0 text-black-50">{{ $kontak_kami->subtitle }}</p>
            </div>

            <div class="row g-4 align-items-center">
                <div class="col-lg-6 col-xl-6 contact-form wow fadeInLeft" data-wow-delay="0.1s">
                    <h2 class="display-5 text-white mb-2">Get in Touch</h2>
                    <form action="{{ route('pengunjung-website.store') }}" method="POST">
                        {{ csrf_field() }}
                        <div class="row g-3">
                            <div class="col-lg-12 col-xl-12">
                                <div class="form-floating">
                                    <input type="text" name="nama_pengunjung"
                                        class="form-control @error('nama_pengunjung') is-invalid @enderror bg-transparent border border-white"
                                        id="nama_pengunjung" placeholder="Nama Anda">
                                    <label for="nama_pengunjung">Nama Anda</label>

                                    @error('nama_pengunjung')
                                        <small class="invalid-feedback">
                                            <strong>{{ $message }}</strong>
                                        </small>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-lg-12 col-xl-12">
                                <div class="form-floating">
                                    <input type="email" name="email"
                                        class="form-control @error('email') is-invalid @enderror bg-transparent border border-white"
                                        id="email" placeholder="Your Email">
                                    <label for="email">Email Anda</label>

                                    @error('email')
                                        <small class="invalid-feedback">
                                            <strong>{{ $message }}</strong>
                                        </small>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-lg-12 col-xl-12">
                                <div class="form-floating">
                                    <input type="text"
                                        class="form-control @error('no_wa') is-invalid @enderror bg-transparent border border-white"
                                        id="no_wa" placeholder="No. WhatsApp / No. HP">
                                    <label for="no_wa">No. WhatsApp / No. HP</label>

                                    @error('no_wa')
                                        <small class="invalid-feedback">
                                            <strong>{{ $message }}</strong>
                                        </small>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-lg-12 col-xl-6">
                                <div class="form-floating">
                                    <div class="date" id="date" data-target-input="nearest">
                                        <input type="text" name="tanggal_janji_temu" id="tanggal_janji_temu"
                                            class="form-control @error('tanggal_janji_temu') is-invalid @enderror py-3 bg-transparent border border-white datetimepicker-input"
                                            placeholder="Pilih Tanggal" data-target="#date" data-toggle="datetimepicker" />
                                    </div>
                                    @error('tanggal_janji_temu')
                                        <small class="invalid-feedback">
                                            <strong>{{ $message }}</strong>
                                        </small>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-lg-12 col-xl-6">
                                <div class="form-floating">
                                    <div class="time" id="time" data-target-input="nearest">
                                        <input type="text" name="waktu_janji_temu"
                                            class="form-control @error('waktu_janji_temu') is-invalid @enderror py-3 bg-transparent border border-white datetimepicker-input"
                                            placeholder="Pilih Waktu" data-target="#time" data-toggle="datetimepicker" />
                                    </div>
                                    @error('waktu_janji_temu')
                                        <small class="invalid-feedback">
                                            <strong>{{ $message }}</strong>
                                        </small>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-floating">
                                    <textarea class="form-control @error('topik_janji_temu') is-invalid @enderror bg-transparent border border-white"
                                        placeholder="Saya ingin berkonsultasi tentang . . ." id="message" style="height: 160px" name="topik_janji_temu"
                                        id="" cols="30" rows="10"></textarea>
                                    <label for="topik_janji_temu">Topik Janji Temu</label>

                                    @error('topik_janji_temu')
                                        <small class="invalid-feedback">
                                            <strong>{{ $message }}</strong>
                                        </small>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-12">
                                <button class="btn btn-light text-primary w-100 py-3">Atur Janji Temu</button>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="col-lg-6 col-xl-6 wow fadeInUp" data-wow-delay="0.5s">
                    <div class="bg-transparent rounded">
                        <div class="d-flex flex-column align-items-center text-center mb-4">
                            <div class="bg-white d-flex align-items-center justify-content-center mb-3"
                                style="width: 90px; height: 90px; border-radius: 50px;"><i
                                    class="fa fa-map-marker-alt fa-2x text-primary"></i></div>
                            <h4 class="text-dark">Alamat</h4>
                            <p class="mb-0 text-white">{{ $content->alamat_kantor }}</p>
                        </div>
                        <div class="d-flex flex-column align-items-center text-center mb-4">
                            <div class="bg-white d-flex align-items-center justify-content-center mb-3"
                                style="width: 90px; height: 90px; border-radius: 50px;"><i
                                    class="fa fa-phone-alt fa-2x text-primary"></i></div>
                            <h4 class="text-dark">No. Telp / No. WA</h4>
                            <p class="mb-0 text-white">{{ $content->no_telp }}</p>
                            <p class="mb-0 text-white">{{ $content->no_wa }}</p>
                        </div>

                        <div class="d-flex flex-column align-items-center text-center">
                            <div class="bg-white d-flex align-items-center justify-content-center mb-3"
                                style="width: 90px; height: 90px; border-radius: 50px;"><i
                                    class="fa fa-envelope-open fa-2x text-primary"></i></div>
                            <h4 class="text-dark">Email</h4>
                            <p class="mb-0 text-white">{{ $content->email }}</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row g-4 align-items-center mt-2">
                <div class="col-lg-12 col-xl-12 wow fadeInRight" data-wow-delay="0.3s">
                    <div class="d-flex justify-content-center mb-4">
                        <a target="_blank" class="btn btn-lg-square btn-light rounded-circle mx-2"
                            href="{{ $content->facebook }}"><i class="fab fa-facebook-f"></i></a>
                        <a target="_blank" class="btn btn-lg-square btn-light rounded-circle mx-2"
                            href="{{ $content->twitter }}"><i class="fab fa-twitter"></i></a>
                        <a target="_blank" class="btn btn-lg-square btn-light rounded-circle mx-2"
                            href="{{ $content->instagram }}"><i class="fab fa-instagram"></i></a>
                        <a target="_blank" class="btn btn-lg-square btn-light rounded-circle mx-2"
                            href="{{ $content->linkedin }}"><i class="fab fa-linkedin-in"></i></a>
                        <a target="_blank" class="btn btn-lg-square btn-light rounded-circle mx-2"
                            href="{{ $content->youtube }}"><i class="fab fa-youtube"></i></a>
                    </div>
                    <div class="rounded h-100">
                        <iframe class="rounded w-100" style="height: 500px;" loading="lazy"
                            referrerpolicy="no-referrer-when-downgrade"
                            src="https://maps.google.com/maps?q={{ $short_description->latitude }},{{ $short_description->longitude }}&hl=id&z=15&amp;output=embed">
                        </iframe>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Contact End -->
@endsection
