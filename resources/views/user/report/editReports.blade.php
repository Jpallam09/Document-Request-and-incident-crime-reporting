<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Incident Report Details</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    @vite('resources/css/userCss/editReports.css')
    @vite('resources/js/userJs/editReports.js')
</head>
<body>
    <div class="container">

        <!-- Header -->
        <div class="header">
            <h1>Update Your Report</h1>
            <a href="#" onclick="window.history.back()" class="back-link">
                <i class="fas fa-arrow-left"></i>
                Back to List
            </a>
        </div>

        <!-- Report Card -->
        <div class="report-card">
            <div class="report-header">
                <div>
                    <input type="text" id="reportTitle" value="" placeholder="Report Title">
                    <div>
                        Incident Date:
                        <input type="date" id="incidentDate" value="">
                    </div>
                </div>
                <div>
                    <select id="incidentType">
                        <option value="Safety">Safety</option>
                        <option value="Operational">Operational</option>
                        <option value="Security">Security</option>
                        <option value="Environmental">Environmental</option>
                    </select>
                </div>
            </div>

            <!-- Description -->
            <div class="description-section">
                <h3>Description</h3>
                <textarea id="incidentDescription" placeholder="Enter full description..."></textarea>
            </div>

            <!-- Attachments -->
            <div class="attachments-section">
                <h3>Attachments</h3>
                <div class="attachments-grid" id="attachmentsGrid">
                    <!-- JS will insert thumbnails here -->
                </div>

                <div class="upload-section">
                    <label for="newImage">Add New Image</label>
                    <input type="file" id="newImage" accept="image/*" hidden>
                    <label for="newImage" class="upload-btn">Select File</label>
                    <span id="fileName">No file selected</span>
                    <button onclick="addImage()" class="upload-image-btn">
                        <i class="fas fa-upload"></i>
                        Upload Image
                    </button>
                </div>
            </div>
        </div>

        <!-- Action Buttons -->
        <div class="action-buttons">
            <button class="btn-primary" id="updateReportBtn">
                <i class="fas fa-check-circle"></i>
                Update Report
            </button>

            <button onclick="window.history.back()" class="btn-secondary">
                <i class="fas fa-times-circle"></i>
                Discard Edit
            </button>

            <button onclick="confirmDelete()" class="btn-danger">
                <i class="fas fa-trash"></i>
                Delete Report
            </button>
        </div>
    </div>

    <!-- Image Modal -->
    <div id="imageModal" class="modal">
        <span class="close" onclick="closeModal()">&times;</span>
        <span class="prev" onclick="changeImage(-1)">&#10094;</span>
        <span class="next" onclick="changeImage(1)">&#10095;</span>
        <img id="expandedImg" class="modal-content">
        <div id="caption" class="caption"></div>
    </div>
</body>
</html>
