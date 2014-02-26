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

require(['app'], function(App){
    App.initialize();
});
