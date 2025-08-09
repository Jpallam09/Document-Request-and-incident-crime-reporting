<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>User Login</title>

    <!-- Bootstrap CSS (adjust as needed) -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />

    @vite('resources/css/authCss/login.css')
    @vite('resources/js/authJs/login.js')
</head>

<body>
    <main class="container-fluid vh-100">
        <div class="row h-100">
            <!-- Left Panel -->
            <section class="col-md-5 d-flex flex-column justify-content-center text-white px-5"
                style="background-color: #1e40af;" aria-label="About the system">

                <div class="d-flex align-items-center mb-5">
                    <!-- Large logo (left) -->
                    <div class="logo-img me-3">
                        <img src="{{ asset('images/SMI_logo.png') }}" alt="Large Logo" class="img-fluid"
                            style="max-width: 100px; height: auto;">
                    </div>

                    <!-- Vertical divider -->
                    <div class="mx-3" style="width: 2px; height: 100%; background-color: #ccc;"></div>

                    <!-- Stacked smaller logos with text (logos to the left of text) -->
                    <div class="d-flex flex-column gap-2">
                        <!-- First small logo + text -->
                        <div class="d-flex align-items-center">
                            <img src="{{ asset('images/SMI_logo.png') }}" alt="Small Logo 1" class="img-fluid me-2"
                                style="max-width: 40px; height: auto;">
                            <p class="small mb-0">
                                Municipal Disaster Risk Reduction and Management Office – Safeguarding Lives and
                                Properties
                            </p>
                        </div>

                        <!-- Second small logo + text -->
                        <div class="d-flex align-items-center">
                            <img src="{{ asset('images/SMI_logo.png') }}" alt="Small Logo 2" class="img-fluid me-2"
                                style="max-width: 40px; height: auto;">
                            <p class="small mb-0">
                                Local Government Unit – Dedicated to Transparent and Responsive Governance
                            </p>
                        </div>
                    </div>
                </div>

                <h1 class="display-5 fw-bold mb-3 d-flex align-items-center gap-2 mt-5">
                    <span class="highlight">Document</span>
                    <span class="amp">&amp;</span>
                    <span class="highlight">Incident Reporting</span>
                </h1>

                <p class="lead">
                    <span id="typing-text"></span><span class="cursor">|</span>
                </p>
            </section>

            <!-- Right Panel -->
            <section class="col-md-7 d-flex align-items-center justify-content-center px-4"
                style="background-color: #f9fafb;" role="region" aria-labelledby="login-heading">
                <div class="login-card bg-white p-5 rounded shadow-sm" style="max-width: 420px; width: 100%;">
                    <h2 id="login-heading" class="mb-4">Log In to Your Account</h2>

                    @if ($errors->any())
                        <div class="alert alert-danger" role="alert">
                            {{ $errors->first() }}
                        </div>
                    @endif

                    <form class="glow-container" action="{{ route('login.post') }}" method="POST" novalidate>
                        @csrf
                        <div class="mb-3">
                            <label for="email" class="form-label">Email Address</label>
                            <input type="email" id="email" name="email" class="form-control"
                                placeholder="you@example.com" autocomplete="email" required
                                aria-describedby="email-desc" />
                            <div id="email-desc" class="form-text text-danger">Please enter a valid email.</div>
                        </div>

                        <div class="mb-3">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" id="password" name="password" class="form-control"
                                placeholder="Enter your password" autocomplete="current-password" required
                                minlength="8" aria-describedby="password-desc" />
                            <div id="password-desc" class="form-text text-danger">Password must be at least 8
                                characters.</div>
                        </div>

                        <button type="submit" class="btn btn-primary w-100" aria-label="Log in user">Log In</button>
                    </form>
                    <div class="text-center mt-3">
                        <span class="text-white me-2">Don't have an account?</span>
                        <a href="{{ route('register') }}" class="btn btn-outline-light btn-sm">Register</a>
                    </div>
                </div>
            </section>
        </div>
    </main>

    <!-- Bootstrap JS Bundle with Popper (optional, for Bootstrap components) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
