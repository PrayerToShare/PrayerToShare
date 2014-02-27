// This is the overall configuration that will get loaded for all pages/resources
requirejs.config({
    baseUrl: '/assets/js',
    paths: {
        'jquery': '../vendor/jquery/dist/jquery',
        'backbone': '../vendor/backbone/backbone',
        'underscore': '../vendor/underscore/underscore',
    },
    shim: {
        'backbone': {
            deps: ['underscore', 'jquery'],
            exports: 'Backbone'
        },
        'underscore': {
            exports: '_'
        },
        'marionette' : {
            deps : ['jquery', 'underscore', 'backbone'],
            exports : 'Marionette'
        }
    }
});

// Make these libs available on ALL pages
require(['jquery'], function() {});
