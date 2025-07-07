import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: [// authCss
                    'resources/css/authCss/login.css',
                    'resources/css/authCss/index.css',
                    'resources/css/authCss/register.css',
                    'resources/css/authCss/user-main-dashboard.css',
                    'resources/css/authCss/viewReports.css',
                    'resources/css/authCss/userMainDashboard.css',

                    // staffCss
                    'resources/css/staffCss/viewReports.css',

                    // userCss
                    'resources/css/userCss/userIncidentReporting.css',
                    'resources/css/userCss/userDashboardReporting.css',
                    'resources/css/userCss/userProfileReporting.css',
                    'resources/css/userCss/viewReports.css',
                    'resources/css/userCss/editReports.css',



                    //userjs
                    'resources/js/userJs/userIncidentReporting.js',
                    'resources/js/userJs/viewReports.js',
                    'resources/js/userJs/editReports.js',
                    ],
            refresh: true,
        }),
    ],
});
