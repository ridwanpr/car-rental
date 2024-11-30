import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/scss/app.scss',
                'resources/js/app.js',
                'resources/js/price-estimator.js',
                'resources/scss/user-dashboard.scss',
                'resources/js/booking.js',
                'resources/js/booking-list.js',
                'resources/scss/booking-list.scss',
                'resources/js/payment-request.js',
                'resources/js/spinner.js',
                'resources/js/rent-request.js',
            ],
            refresh: true,
        }),
    ],
    css: {
        preprocessorOptions: {
            scss: {
                silenceDeprecations: ['mixed-decls', 'color-functions', 'global-builtin', 'import', 'legacy-js-api']
            },
        }
    }
});