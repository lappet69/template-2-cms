@php
    $identitas = \App\Models\Content::where('active', 1)->where('section_id', 1)->limit(1)->first();
    $content = json_decode($identitas->content);
    $bidang_praktik_parent = \App\Models\Content::where('section_id', '=', 7)
        ->whereNull('parent_content_id')
        ->limit(1)
        ->first();
@endphp



<header id="header" class="header d-flex align-items-center">
    <div class="container-fluid container-xl d-flex align-items-center justify-content-between">

        <a href="{{ route('index') }}" class="logo d-flex align-items-center">
            <!-- Uncomment the line below if you also wish to use an image logo -->
            <!-- <img src="assets/img/logo.png" alt=""> -->
            <h1><img src="{{ asset('frontend/assets/img/' . $content->logo) }}"
                    alt="Logo">{{ $content->nama_website }}</h1>
        </a>

        <i class="mobile-nav-toggle mobile-nav-show bi bi-list"></i>
        <i class="mobile-nav-toggle mobile-nav-hide d-none bi bi-x"></i>
        <nav id="navbar" class="navbar">
            <ul>
                <li><a href="{{ route('index') }}"
                        class="nav-item nav-link {{ empty(request()->segment(1)) ? 'active' : '' }}">Home</a></li>
                <li><a href="{{ route('tentang-kami') }}"
                        class="nav-item nav-link {{ request()->segment(1) == 'tentang-kami' ? 'active' : '' }}">Tentang
                        Kami</a></li>
                <li class="dropdown"><a href="{{ route('area-praktek') }}"><span>Area Praktek</span> <i
                            class="bi bi-chevron-down dropdown-indicator {{ request()->segment(1) == 'area-praktek' ? 'active' : '' }}"></i></a>
                    <ul>
                        @foreach ($bidang_praktik_parent->childcontent as $bid)
                            <li><a
                                    href="{{ route('detailAreaPraktek', $bid->slug) }}"target="_blank">{{ $bid->title }}</a>
                            </li>
                        @endforeach

                    </ul>
                </li>
                <li><a
                        href="{{ route('tim-kami') }}"class="nav-item nav-link {{ request()->segment(1) == 'tim-kami' ? 'active' : '' }}">Tim
                        Kami</a></li>
                <li><a href="{{ route('artikel-publikasi') }}"
                        class="nav-item nav-link {{ request()->segment(1) == 'artikel-publikasi' ? 'active' : '' }}">Artikel
                        &
                        Publikasi</a></li>
                <li><a href="{{ route('kontak-kami') }}"
                        class="nav-item nav-link {{ request()->segment(1) == 'kontak-kami' ? 'active' : '' }}">Kontak
                        kami</a></li>


            </ul>
        </nav><!-- .navbar -->

    </div>
</header><!-- End Header -->
