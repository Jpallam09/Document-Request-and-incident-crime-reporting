<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Municipality Document Request & Incident Reporting</title>
    <!-- External Libraries -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
    @vite('resources/css/authCss/index.css')
    @vite('resources/js/authjs/index.js')
</head>

<body>
    <x-modals.index-modal />

    <main>
        <!-- Hero Section -->
        <section class="hero d-flex align-items-center text-center text-white position-relative">
            <img src="{{ asset('images/index4.webp') }}" class="hero-bg" alt="Hero Background">
            <div class="overlay"></div>
            <div class="container position-relative">
                <h1 class="display-3 fw-bold">Welcome to MyApp</h1>
                <p class="lead mb-4">Your one-stop solution for amazing features and tools.</p>
                <a href="#features" class="btn btn-light btn-lg">Discover More</a>
            </div>
        </section>

        <!-- Features Section -->
        <section id="features" class="features text-center text-white position-relative py-5">
            <img src="{{ asset('images/index3.webp') }}" class="features-bg" alt="Features Background">
            <div class="overlay"></div>
            <div class="container position-relative">
                <h2 class="mb-5">Features</h2>
                <div class="row">
                    <div class="col-md-4 mb-3">
                        <div class="p-4 shadow-sm rounded bg-light text-dark">
                            <h4>Feature One</h4>
                            <p>Short description of feature one goes here.</p>
                        </div>
                    </div>
                    <div class="col-md-4 mb-3">
                        <div class="p-4 shadow-sm rounded bg-light text-dark">
                            <h4>Feature Two</h4>
                            <p>Short description of feature two goes here.</p>
                        </div>
                    </div>
                    <div class="col-md-4 mb-3">
                        <div class="p-4 shadow-sm rounded bg-light text-dark">
                            <h4>Feature Three</h4>
                            <p>Short description of feature three goes here.</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- About Section -->
        <section id="about" class="about text-white d-flex align-items-center position-relative py-5">
            <img src="{{ asset('images/index1.webp') }}" class="about-bg" alt="About Background">
            <div class="overlay"></div>
            <div class="container position-relative">
                <h2 class="text-center mb-5">About Us</h2>
                <div class="row align-items-center">
                    <div class="col-md-6 mb-3">
                        <img src="{{ asset('images/index2.webp') }}" class="img-fluid rounded shadow-sm" alt="About">
                    </div>
                    <div class="col-md-6 mb-3">
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque sit amet accumsan arcu.
                            Proin euismod, nisi vel consectetur elementum, nisl leo ultricies justo, at varius justo eros
                            et ligula.</p>
                        <p>We provide top-notch solutions with a focus on performance, security, and user experience.</p>
                        <a href="#contact" class="btn btn-light mt-3">Learn More</a>
                    </div>
                </div>
            </div>
        </section>
    </main>

    <!-- Footer -->
    <footer class="py-4 bg-dark text-white text-center">
        <div class="container">
            &copy; 2025 MyApp. All rights reserved.
        </div>
    </footer>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
