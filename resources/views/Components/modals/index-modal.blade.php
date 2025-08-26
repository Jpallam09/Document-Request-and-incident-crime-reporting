<section id="introSection" class="vh-100 d-flex flex-column bg-dark text-white">
    <nav class="navbar navbar-expand-lg navbar-dark bg-transparent fixed-top transparent-navbar">
        <div class="container-fluid">
            <a class="navbar-brand" aria-label="Homepage">
                <img src="{{ asset('images/SMI_logo.png') }}" height="40" class="d-inline-block align-text-top" />
                <strong>Municipality of San Mateo</strong>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarExample01"
                aria-controls="navbarExample01" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarExample01">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item"><a class="nav-link active" href="#top" id="homeLink">Home</a></li>
                    <li class="nav-item"><a class="nav-link" href="#hero" data-bs-toggle="tooltip" data-bs-placement="bottom" title="See Features">Features</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('login') }}">Login</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('register') }}">Register</a></li>
                </ul>
                <ul class="navbar-nav list-inline">
                    <li class="nav-item"><a class="nav-link" href="https://facebook.com/municipality" target="_blank"><i
                                class="fab fa-facebook-f"></i></a></li>
                    <li class="nav-item"><a class="nav-link" href="https://twitter.com/municipality" target="_blank"><i
                                class="fab fa-twitter"></i></a></li>
                    <li class="nav-item">
                        <a class="nav-link faq-link" href="#faq" data-bs-toggle="tooltip" data-bs-placement="bottom"
                            title="Go to FAQ">
                            <i class="fas fa-question-circle"></i>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="flex-grow-1 d-flex align-items-center justify-content-center" data-bs-pause="false">
        <div id="introCarousel" class="carousel slide carousel-fade w-100 h-100" data-bs-ride="carousel"
            data-bs-interval="6000">

            <!-- Indicators -->
            <div class="carousel-indicators">
                <button type="button" data-bs-target="#introCarousel" data-bs-slide-to="0" class="active"></button>
                <button type="button" data-bs-target="#introCarousel" data-bs-slide-to="1"></button>
                <button type="button" data-bs-target="#introCarousel" data-bs-slide-to="2"></button>
            </div>

            <div class="flex-grow-1 d-flex align-items-center justify-content-center">
                <div id="introCarousel" class="carousel slide carousel-fade w-100 h-90" data-bs-ride="carousel"
                    data-bs-interval="6000" data-bs-pause="false">

                    <!-- Indicators -->
                    <div class="carousel-indicators">
                        <button type="button" data-bs-target="#introCarousel" data-bs-slide-to="0"
                            class="active"></button>
                        <button type="button" data-bs-target="#introCarousel" data-bs-slide-to="1"></button>
                        <button type="button" data-bs-target="#introCarousel" data-bs-slide-to="2"></button>
                    </div>

                    <!-- Carousel items -->
                    <div class="carousel-inner vh-100">
                        <div class="carousel-item active vh-100">
                            <img src="{{ asset('images/carousel1.jpg') }}" class="d-block w-100 h-100 object-fit-cover"
                                alt="Slide 1">
                            <div class="carousel-caption d-none d-md-block text-white text-center">
                                <h1 class="fw-bold">Welcome to the Municipality Service Portal</h1>
                                <h5>Document Requests and Incident Reporting Made Easy</h5>
                            </div>
                        </div>

                        <div class="carousel-item vh-100">
                            <img src="{{ asset('images/carousel2.jpg') }}" class="d-block w-100 h-100 object-fit-cover"
                                alt="Slide 2">
                            <div class="carousel-caption d-none d-md-block text-white text-center">
                                <h2 class="fw-bold">Your One-Stop Portal for Municipal Services</h2>
                                <p>Submit document requests and report incidents anytime, anywhere.</p>
                            </div>
                        </div>

                        <div class="carousel-item vh-100">
                            <img src="{{ asset('images/carousel3.jpg') }}"
                                class="d-block w-100 h-100 object-fit-cover" alt="Slide 3">
                            <div class="carousel-caption d-none d-md-block text-white text-center">
                                <h2 class="fw-bold">Secure, Fast, and Reliable</h2>
                            </div>
                        </div>
                    </div>

                    <!-- Controls -->
                    <button class="carousel-control-prev" type="button" data-bs-target="#introCarousel"
                        data-bs-slide="prev">
                        <span class="carousel-control-prev-icon"></span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#introCarousel"
                        data-bs-slide="next">
                        <span class="carousel-control-next-icon"></span>
                    </button>
                </div>
            </div>

</section>

</section>
