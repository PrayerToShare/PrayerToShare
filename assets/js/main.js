// This is the overall configuration that will get loaded for all pages/resources
requirejs.config({
    baseUrl: '/assets/js',
    paths: {
        'jquery': '../vendor/jquery/dist/jquery',
        'domReady': '../vendor/requirejs-domready/domReady',
        'bootstrap.alert': "../vendor/bootstrap/js/alert"
    },
    shim: {
        'bootstrap.alert': {
            deps: ['jquery']
        }
    }
});

// Make these libs available on ALL pages
require(['jquery', 'bootstrap.alert'], function() {});
