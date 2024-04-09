@php
    $identitas = \App\Models\Content::where('active', 1)->where('section_id', 1)->limit(1)->first();
    $content = json_decode($identitas->content);
    $bidang_praktik_parent = \App\Models\Content::where('section_id', '=', 7)
        ->whereNull('parent_content_id')
        ->limit(1)
        ->first();
@endphp

<!-- Topbar Start -->
<div class="container-fluid bg-dark text-white-50 py-2 px-0 d-none d-lg-block">
    <div class="row gx-0 align-items-center">
        <div class="col-lg-7 px-5 text-start">
            <div class="h-100 d-inline-flex align-items-center me-4">
                <small class="fa fa-phone-alt me-2"></small>
                <small><a href="https://wa.me/{{ $content->no_wa }}" target="_blank"
                        class="text-light me-4">{{ $content->no_wa }}</a></small>
            </div>
            <div class="h-100 d-inline-flex align-items-center me-4">
                <small class="far fa-envelope-open me-2"></small>
                <small> <a href="mailto:{{ $content->email }}" class="text-light me-0">{{ $content->email }}</a></small>
            </div>
            <div class="h-100 d-inline-flex align-items-center me-4">
                {{-- <small class="far fa-clock me-2"></small> --}}
                {{-- <small>Mon - Fri : 09 AM - 09 PM</small> --}}
            </div>
        </div>
        <div class="col-lg-5 px-5 text-end">
            <div class="h-100 d-inline-flex align-items-center">
                <a class="text-white-50 ms-4" target="_blank" href="{{ $content->facebook }}"><i
                        class="fab fa-facebook-f"></i></a>
                <a class="text-white-50 ms-4" target="_blank" href="{{ $content->twitter }}"><i
                        class="fab fa-twitter"></i></a>
                <a class="text-white-50 ms-4" target="_blank" href="{{ $content->linkedin }}"><i
                        class="fab fa-linkedin-in"></i></a>
                <a class="text-white-50 ms-4" target="_blank" href="{{ $content->instagram }}"><i
                        class="fab fa-instagram"></i></a>
                <a class="text-white-50 ms-4" target="_blank" href="{{ $content->youtube }}"><i
                        class="fab fa-youtube"></i></a>
            </div>
        </div>
    </div>
</div>
<!-- Topbar End -->

<!-- Navbar Start -->
<nav class="navbar navbar-expand-lg bg-white navbar-light sticky-top px-4 px-lg-5">
    <a href="{{ route('index') }}" class="navbar-brand d-flex align-items-center">
        <h1 class="m-0">
            <img src="{{ asset('frontend/assets/img/' . $content->logo) }}"
                alt="Logo">{{ $content->nama_website }}
        </h1>
    </a>
    <button type="button" class="navbar-toggler" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarCollapse">
        <div class="navbar-nav mx-auto bg-light rounded pe-4 py-3 py-lg-0">
            <a href="{{ route('index') }}"
                class="nav-item nav-link {{ empty(request()->segment(1)) ? 'active' : '' }}">Home</a>
            <a href="{{ route('tentang-kami') }}"
                class="nav-item nav-link {{ request()->segment(1) == 'tentang-kami' ? 'active' : '' }}">Tentang
                Kami</a>
            <div class="nav-item dropdown">
                <a href="{{ route('area-praktek') }}"
                    class="nav-link dropdown-toggle {{ request()->segment(1) == 'area-praktek' ? 'active' : '' }}"
                    data-bs-toggle="dropdown">Area Praktek</a>
                <div class="dropdown-menu bg-light border-0 m-0">
                    @foreach ($bidang_praktik_parent->childcontent as $bid)
                        <a href="{{ route('detailAreaPraktek', $bid->slug) }}" class="dropdown-item"
                            target="_blank">{{ $bid->title }}</a>
                    @endforeach

                </div>
            </div>
            <a href="{{ route('tim-kami') }}"
                class="nav-item nav-link {{ request()->segment(1) == 'tim-kami' ? 'active' : '' }}">Tim Kami</a>
            <a href="{{ route('artikel-publikasi') }}"
                class="nav-item nav-link {{ request()->segment(1) == 'artikel-publikasi' ? 'active' : '' }}">Artikel &
                Publikasi</a>
            <a href="{{ route('kontak-kami') }}"
                class="nav-item nav-link {{ request()->segment(1) == 'kontak-kami' ? 'active' : '' }}">Kontak kami</a>
            <a href="https://wa.me/{{ $content->no_wa }}" target="_blank" class="nav-item nav-link">Contact Us</a>
        </div>
    </div>
    <a href="https://wa.me/{{ $content->no_wa }}" target="_blank"
        class="btn btn-outline-primary px-3 d-none d-lg-block">Konsultasi Sekarang</a>
</nav>
<!-- Navbar End -->
