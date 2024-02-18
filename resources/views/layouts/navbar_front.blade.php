<!-- ======= Header ======= -->
<header id="header" class="fixed-top">
    <div class="container-academy d-flex align-items-center">
        <!-- <h1 class="logo me-auto"><a href="index.html">Mentor</a></h1> -->
        <!-- Uncomment below if you prefer to use an image logo -->
        <a href="{{ route('index') }}" class="logo me-auto"><img src="{{ asset('front/assets/img/academy-logo.png') }}"
                alt="" class="img-fluid" /></a>

        <nav id="navbar" class="navbar order-last order-lg-0">
            <ul>
                <li><a class="active" href="{{ route('index') }}">Home</a></li>
                <li class="dropdown">
                    <a href="{{ route('program') }}"><span>Program</span> </a>
                </li>
                <li><a href="{{ route('about') }}">About</a></li>
            </ul>
            <i class="bi bi-list mobile-nav-toggle"></i>
        </nav>
        <!-- .navbar -->

        <a href="{{ route('registrasi') }}" class="get-started-btn">Register</a>
    </div>
</header>
<!-- End Header -->
