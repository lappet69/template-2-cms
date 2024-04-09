<!-- ======= Header ======= -->
<header id="header" class="fixed-top">
    <div class="container d-flex align-items-center">
        <!-- <h1 class="logo me-auto"><a href="index.html">Mentor</a></h1> -->
        <!-- Uncomment below if you prefer to use an image logo -->
        <a href="{{ route('index') }}" class="logo me-auto">
            <img src="{{ asset('front/assets/img/mpp-logo.png') }}" alt="" class="img-fluid" />
        </a>

        <nav id="navbar" class="navbar order-last order-lg-0">
            <ul>
                <li><a class="{{ request()->segment(1) == '' ? 'active' : '' }}" href="{{ route('index') }}">Beranda</a>
                </li>
                <li><a href="{{ route('about') }}"
                        class="{{ request()->segment(1) == 'tentang' ? 'active' : '' }}">Tentang</a></li>
                <li><a href="{{ route('about') }}"
                        class="{{ request()->segment(1) == 'konsultan-hukum' ? 'active' : '' }}">Konsultan Hukum</a>
                </li>
                <li class="dropdown">
                    <a href="{{ route('program') }}"
                        class="{{ request()->segment(1) == 'layanan' ? 'active' : '' }}"><span>Layanan</span> </a>
                </li>
                <li><a href="{{ route('about') }}"
                        class="{{ request()->segment(1) == 'berita' ? 'active' : '' }}">Berita</a></li>
                <li><a href="{{ route('about') }}"
                        class="{{ request()->segment(1) == 'kontak' ? 'active' : '' }}">Kontak</a></li>
            </ul>
            <i class="bi bi-list mobile-nav-toggle"></i>
        </nav>
        <!-- .navbar -->
    </div>
</header>
<!-- End Header -->
