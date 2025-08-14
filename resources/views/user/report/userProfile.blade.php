<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Profile</title>

    {{-- Bootstrap & Icons --}}
    <link rel="stylesheet" href="{{ asset('bootstrap-5.3.7-dist/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />

    {{-- Vite CSS --}}
    @vite('resources/css/userCss/userProfile.css')
    @vite('resources/css/componentsCss/navbarCss/shared-navbar.css')
    @vite('resources/js/componentsJs/navbar.js')
</head>

<body>
    <div class="layout d-flex">
        @include('components.navbar.user-navbar')

        <div class="page-content flex-grow-1 pt-5 px-4">
            <div class="container py-4">
<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-12 col-md-8 col-lg-6">
            <div class="card shadow-sm rounded">
                <div class="card-body p-4">
                    <h2 class="card-title text-center mb-4">Edit Profile</h2>

                    {{-- Avatar --}}
                    <div class="d-flex justify-content-center mb-4">
                        <div class="text-center">
                            <img class="profile-picture rounded-circle img-fluid border border-3 border-primary mb-2 w-25" 
                                 id="profilePicture" 
                                 src="{{ asset('images/pfp.png') }}" 
                                 alt="User Profile Picture">
                            <input type="file" id="profilePictureInput" name="profilePicture" accept="image/*" 
                                   class="form-control form-control-sm mt-2">
                        </div>
                    </div>


                        {{-- Profile Form --}}
                        <form id="editProfileForm" method="POST" action="" enctype="multipart/form-data">
                            @csrf
                            <div class="row g-3">
                                {{-- Name --}}
                                <div class="col-12 col-md-6">
                                    <label for="name" class="form-label">Name</label>
                                    <input type="text" id="name" name="name" value="John Doe" class="form-control" required>
                                </div>

                                {{-- Username --}}
                                <div class="col-12 col-md-6">
                                    <label for="username" class="form-label">Username</label>
                                    <input type="text" id="username" name="username" value="johndoe123" class="form-control" required>
                                </div>

                                {{-- Email --}}
                                <div class="col-12">
                                    <label for="email" class="form-label">Email</label>
                                    <input type="email" id="email" name="email" value="john.doe@example.com" class="form-control" required>
                                </div>

                            {{-- Buttons --}}
                            <div class="d-flex justify-content-between mt-4 gap-2">
                                <button type="button" class="btn btn-outline-secondary flex-fill"
                                    onclick="window.location.href='{{ route('user.report.userDashboardReporting') }}'">
                                    Back to Dashboard
                                </button>
                                <button type="submit" class="btn btn-primary flex-fill">Save Changes</button>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Bootstrap JS --}}
    <script src="{{ asset('bootstrap-5.3.7-dist/js/bootstrap.bundle.min.js') }}"></script>
    @include('sweetalert::alert')
</body>

</html>
