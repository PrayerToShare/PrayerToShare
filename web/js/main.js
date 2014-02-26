// This is the overall configuration that will get loaded for all pages/resources
requirejs.config({
    paths: {
        'jquery': '/components/jquery/dist/jquery',
        'backbone': '/components/backbone/backbone',
        'underscore': '/components/underscore/underscore',
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
