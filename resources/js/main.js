var chisel = angular.module('myApp', [
    'ngRoute',
    'ui.bootstrap',
    'ngAnimate',
    'angularFileUpload',
]);

chisel.config(function($routeProvider, $locationProvider, $httpProvider) {
    $routeProvider
        .when('/home', {
            templateUrl: 'html/home.html',
            controller: 'homeController',
        })
        //.when('/launch', {
        //    templateUrl: 'html/launch.html',
        //    controller: 'launchController',
        //})
        .when('/launch_old', {
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
        { name: 'Georgia', value: 'Georgia, serif' },
        { name: 'Palatino Linotype', value: '"Palatino Linotype", "Book Antiqua", Palatino, serif' },
        { name: 'Times New Roman', value: '"Times New Roman", Times, serif' },
        { name: 'Arial', value: 'Arial, Helvetica, sans-serif' },
        { name: 'Arial Black', value: '"Arial Black", Gadget, sans-serif' },
        { name: 'Comic Sans MS', value: '"Comic Sans MS", cursive, sans-serif' },
        { name: 'Impact', value: 'Impact, Charcoal, sans-serif' },
        { name: 'Lucida Sans Unicode', value: '"Lucida Sans Unicode", "Lucida Grande", sans-serif' },
        { name: 'Tahoma', value: 'Tahoma, Geneva, sans-serif' },
        { name: 'Trebuchet MS', value: '"Trebuchet MS", Helvetica, sans-serif' },
        { name: 'Verdana', value: 'Verdana, Geneva, sans-serif' },
        { name: 'Courier New', value: '"Courier New", Courier, monospace' },
        { name: 'Lucida Console', value: '"Lucida Console", Monaco, monospace' },
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

chisel.directive('customOnChange', function() {
    return {
        restrict: 'A',
        link: function(scope, element, attrs) {
            var onChangeHandler = scope.$eval(attrs.customOnChange);
            element.bind('change', onChangeHandler);
        }
    };
});
