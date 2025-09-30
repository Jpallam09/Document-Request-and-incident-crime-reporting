    import { defineConfig } from 'vite';
    import laravel from 'laravel-vite-plugin';

    export default defineConfig({
        plugins: [
            laravel({
                input: [// authCss
                        'resources/css/authcss/forms.css',
                        'resources/css/authcss/index.css',
                        'resources/css/authcss/user-main-dashboard.css',

                        // staffCss
                        'resources/css/staffcss/staff-dashboard.css',
                        'resources/css/staffcss/staff-deletion-requests.css',
                        'resources/css/staffcss/staff-view-reports-full-details.css',
                        'resources/css/staffcss/staff-report-view.css',
                        'resources/css/staffcss/staff-update-requests.css',
                        'resources/css/staffcss/staff-track-report.css',

                        // userCss
                        'resources/css/usercss/user-incident-reporting.css',
                        'resources/css/usercss/user-dashboard-reporting.css',
                        'resources/css/usercss/user-profile.css',
                        'resources/css/usercss/view-reports.css',
                        'resources/css/usercss/edit-reports.css',

                        //componentsCss
                        'resources/css/componentscss/navbarcss/navbar.css',
                        'resources/css/componentscss/navbarcss/shared-navbar.css',
                        'resources/css/componentscss/modalcss/view-request-modal.css',
                        'resources/css/componentscss/modalcss/form-modal.css',

                        //componentsJs
                        'resources/js/componentsjs/navbar.js',
                        'resources/js/componentsjs/view-request-modal.js',
                        'resources/js/componentsjs/form-modal.js',
                        'resources/js/componentsjs/map.js',
                        'resources/js/componentsjs/user-tutorial.js',

                        //authJs
                        'resources/js/authjs/login.js',
                        'resources/js/authjs/register.js',
                        'resources/js/authjs/index.js',

                        //userjs
                        'resources/js/userjs/user-incident-reporting.js',
                        'resources/js/userjs/user-incident-reporting-location.js',
                        'resources/js/userjs/view-reports.js',
                        'resources/js/userjs/edit-reports.js',
                        'resources/js/userjs/edit-reports-location.js',
                        'resources/js/userjs/user-rrofile.js',

                        // staffjs
                        'resources/js/staffjs/staff-dashboard.js',
                        'resources/js/staffjs/staff-deletion-request.js',
                        'resources/js/staffjs/staff-trackReport.js',
                        'resources/js/staffjs/staff-view-reports-full-details.js',
                        'resources/js/staffjs/staff-report-view.js',
                        'resources/js/staffjs/staff-update-requests.js',
                        'resources/js/staffjs/staff-track-report.js',
                        'resources/js/staffjs/staff-show-edit-request.js',
                        ],
                refresh: true,
            }),
        ],
    });
