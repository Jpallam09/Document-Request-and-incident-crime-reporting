    import { defineConfig } from 'vite';
    import laravel from 'laravel-vite-plugin';

    export default defineConfig({
        plugins: [
            laravel({
                input: [// authCss
                        'resources/css/authCss/forms.css',
                        'resources/css/authCss/index.css',
                        'resources/css/authCss/user-main-dashboard.css',
                        'resources/css/authCss/viewReports.css',
                        'resources/css/authCss/userMainDashboard.css',

                        // staffCss
                        'resources/css/staffCss/staffDashboard.css',
                        'resources/css/staffCss/staffDeletionRequests.css',
                        'resources/css/staffCss/staffViewReportsFullDetails.css',
                        'resources/css/staffCss/staffReportView.css',
                        'resources/css/staffCss/staffUpdateRequests.css',

                        // userCss
                        'resources/css/userCss/userIncidentReporting.css',
                        'resources/css/userCss/userDashboardReporting.css',
                        'resources/css/userCss/userProfile.css',
                        'resources/css/userCss/viewReports.css',
                        'resources/css/userCss/editReports.css',

                        //componentsCss
                        'resources/css/componentsCss/navbarCss/navbar.css',
                        'resources/css/componentsCss/navbarCss/Shared-navbar.css',
                        'resources/css/componentsCss/ModalCss/viewRequestModal.css',
                        'resources/css/componentsCss/ModalCss/form-modal.css',

                        //componentsJs
                        'resources/js/componentsJs/navbar.js',
                        'resources/js/componentsJs/shared-navbar.js',
                        'resources/js/componentsJs/viewRequestModal.js',
                        'resources/js/componentsJs/form-modal.js',

                        //authJs
                        'resources/js/authJs/login.js',
                        'resources/js/authJs/register.js',
                        'resources/js/authJs/index.js',

                        //userjs
                        'resources/js/userJs/userIncidentReporting.js',
                        'resources/js/userJs/userIncidentReportingLocation.js',
                        'resources/js/userJs/viewReports.js',
                        'resources/js/userJs/editReports.js',
                        'resources/js/userJs/editReportsLocation.js',
                        'resources/js/userJs/userProfile.js',

                        // staffjs
                        'resources/js/staffJs/staffDashboard.js',
                        'resources/js/staffJs/staffDeletionRequest.js',
                        'resources/js/staffJs/staffViewReportsFullDetails.js',
                        'resources/js/staffJs/staffReportView.js',
                        'resources/js/staffJs/staffUpdateRequests.js',
                        ],
                refresh: true,
            }),
        ],
    });
