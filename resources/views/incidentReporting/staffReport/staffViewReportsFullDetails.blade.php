<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Staff - Report Details</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css"/>
    @vite('resources/css/staffCss/staffViewReportsFullDetails.css')
    @vite('resources/js/staffJs/staffViewReportsFullDetails.js')
    @vite('resources/css/componentsCss/navbarCss/Shared-navbar.css')
    @vite('resources/js/componentsJs/navbar.js')
</head>

<body>
    <main class="layout">
        @include('components.navbar.Shared-navbar')
        <section class="page-content">
            <div class="report-details-container">
                <h1 class="report-title">Noise Complaint</h1>

                <div class="report-meta">
                    <p><strong>Type:</strong> Environmental</p>
                    <p><strong>Date Submitted:</strong> 2025-07-08</p>
                    <p><strong>Submitted by:</strong> john_doe</p>
                </div>

                <div class="report-description">
                    <h3>Description</h3>
                    <p>
                        There was loud construction noise at 3 AM near the residential building.
                        The noise lasted for over 2 hours and caused sleep disturbances.
                    </p>
                </div>

                <div class="report-images">
                    <h3>Attached Images</h3>

                    <!-- Modal Viewer -->
                    <div id="imageModal" class="image-modal">
                        <span class="prev" onclick="changeImage(-1)">&#10094;</span>
                        <span class="next" onclick="changeImage(1)">&#10095;</span>
                        <img id="expandedImg" class="modal-img" src="" alt="Zoomed Image">
                        <div id="caption" class="caption-text"></div>
                    </div>
                </div>
            </div>
        </section>
    </main>
</body>
</html>
