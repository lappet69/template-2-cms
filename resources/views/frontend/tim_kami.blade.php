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
            <h3 class="text-white display-3 mb-4 wow fadeInDown" data-wow-delay="0.1s">Tim Kami</h1>
                <ol class="breadcrumb justify-content-center mb-0 wow fadeInDown" data-wow-delay="0.3s">
                    <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                    <li class="breadcrumb-item"><a href="#">Pages</a></li>
                    <li class="breadcrumb-item active text-primary">Tim Kami</li>
                </ol>
        </div>
    </div>
    <!-- Header End -->

    <!-- Team Start -->
    <div class="container-fluid team py-5">
        <div class="container py-5">
            <div class="section-title mb-5 wow fadeInUp" data-wow-delay="0.1s">
                <div class="sub-style">
                    <h4 class="sub-title px-3 mb-0">{{ $lawyer->title }}</h4>
                </div>
                <h1 class="display-3 mb-4">{{ $lawyer->subtitle }}</h1>
                <p class="mb-0">{{ $lawyer->short_description }}</p>
            </div>

            <div class="d-flex justify-content-center">
                <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                    @foreach (\App\Models\Jabatan::all() as $key => $jabatan)
                        <li class="nav-item" role="presentation">
                            <button class="nav-link {{ $key == 0 ? 'active' : '' }}" id="{{ $jabatan->slug }}-tab"
                                data-bs-toggle="pill" data-bs-target="#{{ $jabatan->slug }}" type="button" role="tab"
                                aria-controls="{{ $jabatan->slug }}"
                                aria-selected="{{ $key == 0 ? 'true' : 'false' }}">{{ $jabatan->name }}</button>
                        </li>
                    @endforeach
                </ul>
            </div>

            <div class="tab-content" id="pills-tabContent">
                @foreach (\App\Models\Jabatan::all() as $key => $jabatan)
                    <div class="tab-pane fade {{ $key == 0 ? 'show active' : '' }}" id="{{ $jabatan->slug }}"
                        role="tabpanel" aria-labelledby="{{ $jabatan->slug }}-tab">
                        <div class="lawyer-item">
                            <h4 class="text-center text-primary">{{ $jabatan->name }}</h4>
                            <p class="text-center">{{ $jabatan->subtitle }}</p>

                            <div class="row g-4 justify-content-center">
                                @php
                                    $count = 0.1;
                                @endphp

                                @foreach ($jabatan->lawyer as $lawy)
                                    @php
                                        $short_description = json_decode($lawy->short_description, true);
                                    @endphp

                                    <div class="col-md-6 col-lg-6 col-xl-3">
                                        <div class="team-item rounded">
                                            <div class="team-img rounded-top h-100">
                                                {!! isset($lawy->asset->thumbnail)
                                                    ? '<img class="img-fluid rounded-top w-100" alt="" src="' .
                                                        asset('frontend/assets/img/' . $lawy->asset->thumbnail) .
                                                        '">'
                                                    : '<img class="img-fluid rounded-top w-100" alt="" src="' . asset('frontend/assets/img/lawyer-icon.jpeg') . '">' !!}

                                                <div class="team-icon d-flex justify-content-center">
                                                    <a class="btn btn-square btn-primary text-white rounded-circle mx-1"
                                                        href="{{ $short_description['media_sosial']['facebook'] }}"><i
                                                            class="fab fa-facebook-f"></i></a>
                                                    <a class="btn btn-square btn-primary text-white rounded-circle mx-1"
                                                        href="{{ $short_description['media_sosial']['twitter'] }}"><i
                                                            class="fab fa-twitter"></i></a>
                                                    <a class="btn btn-square btn-primary text-white rounded-circle mx-1"
                                                        href="{{ $short_description['media_sosial']['instagram'] }}"><i
                                                            class="fab fa-instagram"></i></a>
                                                    <a class="btn btn-square btn-primary text-white rounded-circle mx-1"
                                                        href="{{ $short_description['media_sosial']['linkedin'] }}"><i
                                                            class="fab fa-linkedin-in"></i></a>
                                                </div>
                                            </div>
                                            <div
                                                class="team-content text-center border border-primary border-top-0 rounded-bottom p-4">
                                                <h5>{{ $lawy->title }}</h5>
                                                <p class="mb-0">{{ $lawy->jabatan->name }}</p>
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
                @endforeach
            </div>
        </div>
    </div>
    <!-- Team End -->

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
    </div>
@endsection
