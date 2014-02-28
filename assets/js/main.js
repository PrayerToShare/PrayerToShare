// This is the overall configuration that will get loaded for all pages/resources
requirejs.config({
    baseUrl: '/assets/js',
    paths: {
        'jquery': '../vendor/jquery/dist/jquery',
        'domReady': '../vendor/requirejs-domready/domReady'
    }
});

// Make these libs available on ALL pages
require(['jquery'], function() {});
