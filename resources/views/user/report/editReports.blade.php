<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Incident Report Details</title>
    @vite('resources/css/userCss/editReports.css')
    @vite('resources/js/userJs/editReports.js')
</head>
<body>
    <div class="container">
        <!-- Header with back button -->
        <div class="header">
            <h1>Update Incident Report</h1>
            <a href="#" onclick="window.history.back()" class="back-link">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M9.707 14.707a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 1.414L7.414 9H15a1 1 0 110 2H7.414l2.293 2.293a1 1 0 010 1.414z" clip-rule="evenodd" />
                </svg>
                Back to List
            </a>
        </div>

        <!-- Report Card -->
        <div class="report-card">
            <div class="report-header">
                <div>
                    <input type="text" class="text-2xl font-semibold text-gray-800 mb-2" value="Network Outage - Main Data Center" style="width: 100%; padding: 8px; border: 1px solid var(--border); border-radius: 4px;">
                    <div class="text-gray-500 text-sm mb-4">
                        Incident Date: <input type="date" value="2023-05-15" class="font-medium" style="border: 1px solid var(--border); border-radius: 4px; padding: 4px;">
                    </div>
                </div>
                <div class="flex justify-end">
                    <select class="px-4 py-2 rounded-full text-sm font-medium bg-blue-100 text-blue-800" style="border: none; outline: none;">
                        <option>Safety</option>
                        <option selected>Operational</option>
                        <option>Security</option>
                        <option>Environmental</option>
                    </select>
                </div>
            </div>

            <!-- Description Section -->
            <div class="description-section">
                <h3>Description</h3>
                <textarea class="description-box" style="min-height: 200px; width: 100%; padding: 12px; font-family: inherit;">
At approximately 2:15 PM, our monitoring systems detected a complete network outage affecting the main data center. The outage lasted for 47 minutes, during which time all services hosted in this facility were unavailable.

Preliminary investigation suggests the outage was caused by a faulty network switch in the core router stack. The backup unit failed to automatically take over due to a misconfiguration in the failover system.

Emergency procedures were activated immediately:
- Network team dispatched to data center
- Secondary routing paths enabled manually
- Customer notifications sent via status page
- Full incident review initiated

Full service was restored at 3:02 PM after replacing the defective hardware unit and verifying all systems.
                </textarea>
            </div>

            <!-- Attachments Section -->
            <div class="attachments-section">
                <h3>Attachments</h3>
                <div class="attachments-grid">
                    <div class="border rounded-md overflow-hidden relative">
                        <img src="https://storage.googleapis.com/workspace-0f70711f-8b4e-4d94-86f1-2a93ccde5887/image/1374fd6c-9deb-4842-b2da-503e1d8801db.png" alt="Network rack with diagnostic equipment" class="thumbnail" onclick="openImageModal(this.src,'Network rack with diagnostic equipment')">
                        <button class="remove-btn" onclick="removeImage(this.parentNode)">×</button>
                        <div class="p-3 bg-gray-50">
                            <p class="text-sm font-medium text-gray-700"></p>
                        </div>
                    </div>
                </div>
                <div class="mt-4">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Add New Image</label>
                    <div class="flex items-center">
                        <input type="file" id="newImage" accept="image/*" class="hidden">
                        <label for="newImage" class="cursor-pointer bg-gray-100 hover:bg-gray-200 px-4 py-2 rounded-md text-sm font-medium">
                            Select File
                        </label>
                        <span id="fileName" class="ml-2 text-sm text-gray-500">No file selected</span>
                    </div>
                    <button onclick="addImage()" class="mt-2 bg-blue-500 text-white px-4 py-2 rounded-md text-sm font-medium">
                        Upload Image
                    </button>
                </div>
            </div>
        </div>

        <!-- Action Buttons -->
        <div class="action-buttons">
            <button class="btn-primary">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" />
                </svg>
                Update Report
            </button>
            <button onclick="window.history.back()" class="btn-secondary" style="background-color: var(--secondary);">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd" />
                </svg>
                Discard Edit
            </button>
            <button onclick="confirmDelete()" class="btn-danger">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd" />
                </svg>
                Delete Report
            </button>
        </div>
    </div>

    <!-- Image Modal HTML -->
    <div id="imageModal" class="modal">
        <span class="close" onclick="closeModal()">&times;</span>
        <span class="prev" onclick="changeImage(-1)">&#10094;</span>
        <span class="next" onclick="changeImage(1)">&#10095;</span>
        <img class="modal-content" id="expandedImg">
        <div id="caption" class="caption"></div>
    </div>
