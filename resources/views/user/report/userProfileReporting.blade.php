<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Profile</title>
    <link rel="stylesheet" href="{{ asset('bootstrap-5.3.7-dist/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css"/>
    @vite('resources/css/userCss/userProfileReporting.css')
    @vite('resources/css/componentsCss/navbarCss/Shared-navbar.css')
    @vite('resources/js/componentsJs/navbar.js')
</head>
<body>

<div class="container">
    @include('components.navbar.user-navbar')
    <h1>Edit Profile</h1>
    <form id="editProfileForm" method="POST" action="" enctype="multipart/form-data">
        @csrf

        <div class="profile-picture-container">
            <img class="profile-picture" id="profilePicture" src="https://via.placeholder.com/100" alt="User Profile Picture">
            <input type="file" id="profilePictureInput" name="profilePicture" accept="image/*">
        </div>

        <label for="name">Name</label>
        <input type="text" id="name" name="name" value="John Doe" required>

        <label for="email">Email</label>
        <input type="email" id="email" name="email" value="john.doe@example.com" required>

        <label for="username">Username</label>
        <input type="text" id="username" name="username" value="johndoe123" required>

        <label for="bio">Bio</label>
        <textarea id="bio" name="bio" rows="4" required>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</textarea>

        <div class="button-container">
            <button
                type="button"
                class="back-button"
                onclick="window.location.href='{{ route('user.report.userDashboardReporting') }}'">
                Back to Dashboard
            </button>

            <button type="submit" class="save-button">Save Changes</button>
        </div>

    </form>
</div>
@include('sweetalert::alert')
</body>
</html>
