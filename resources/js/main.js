var chisel = angular.module('myApp', [
    'ngRoute',
    'ui.bootstrap',
    'ngAnimate',
]);

chisel.config(function($routeProvider, $locationProvider, $httpProvider) {
    $routeProvider
        .when('/home', {
            templateUrl: 'html/home.html',
            controller: 'homeController',
        })
        .when('/launch', {
            templateUrl: 'html/launch.html',
            controller: 'launchController',
        })
        .otherwise({ redirectTo: '/home' });

    $locationProvider.html5Mode(true);
    $httpProvider.defaults.headers.common["X-Requested-With"] = 'XMLHttpRequest';
});

chisel.factory('chisel_var', function() {
    var items = {};
    var itemsService = {};

    items.fonts = [
        { name: 'Helvetica', value: 'helvetica' },
        { name: 'Arial', value: 'Arial' },
        { name: 'Times', value: 'Times' },
        { name: 'Times New Roman', value: 'Times New Roman' },
        { name: 'Courier', value: 'Courier' },
        { name: 'Verdana', value: 'Verdana' },
    ];

    itemsService.get = function(name) {
        if (items[name]) {
            return items[name];
        }
    };

    itemsService.id_to_obj = function(name, id) {
        if (items[name]) {
            var result = $.grep(items[name], function(e) {
                return e.id == id;
            });
            if (result.length == 1) {
                return result[0];
            } else {
                return {};
            }
        }
    }
    return itemsService;
});
