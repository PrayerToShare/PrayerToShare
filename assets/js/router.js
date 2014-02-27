define([
    'jquery',
    'underscore',
    'backbone',
], function($, _, Backbone) {
    var AppRouter = Backbone.Router.extend({
        routes: {
            '*actions': 'defaultAction'
        }
    });

    var initialize = function() {
        var appRouter = new AppRouter();

        appRouter.on('defaultAction', function(actions) {
            alert(actions);
        });

        Backbone.history.start();
    };

    return {
        initialize: initialize
    };
});
