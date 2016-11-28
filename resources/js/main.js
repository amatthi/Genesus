var chisel = angular.module('myApp', [
    'ngRoute',
    'ui.bootstrap',
    'ngAnimate',
    'angularFileUpload',
    'angularMoment',
    'rzModule',
    'timer',
]);

chisel.config(function($routeProvider, $locationProvider, $httpProvider) {
    $routeProvider
    .when('/home', {
        templateUrl: 'html/home.html',
        controller: 'homeController',
    })
    .when('/sell', {
        templateUrl: 'html/sell.html',
        controller: 'homeController',
    })
    //.when('/launch', {
    //    templateUrl: 'html/launch.html',
    //    controller: 'launchController',
    //})
    .when('/store', {
        templateUrl: 'html/store.html',
        controller: 'storeController',
    })
    .when('/faq', {
        templateUrl: 'html/faq.html',
    })
    .when('/contact_us', {
        templateUrl: 'html/contact_us.html',
    })
    .when('/how_it_works', {
        templateUrl: 'html/how_it_works.html',
    })
    .when('/why_genesus', {
        templateUrl: 'html/why_genesus.html',
    })
    .when('/non_gmo', {
        templateUrl: 'html/non_gmo.html',
    })
    .when('/feeling_guarantee', {
        templateUrl: 'html/feeling_guarantee.html',
    })
    .when('/shipping', {
        templateUrl: 'html/shipping.html',
    })
    .when('/selling', {
        templateUrl: 'html/selling.html',
    })
    .when('/our_story', {
        templateUrl: 'html/our_story.html',
    })
    .when('/terms', {
        templateUrl: 'html/terms.html',
    })
    .when('/privacy', {
        templateUrl: 'html/privacy.html',
    })
    .when('/thank_you', {
        templateUrl: 'html/thank_you.html',
    })
    .when('/share/:id', {
        templateUrl: 'html/share.html',
        controller: 'shareController',
    })
    .when('/campaign/:slug', {
        templateUrl: 'html/campaign.html',
        controller: 'campaignController',
    })
    .when('/dashboard', {
        templateUrl: 'html/dashboard.html',
        controller: 'dashboardController',
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

chisel.filter('capitalize', function() {
    return function(input) {
        return (!!input) ? input.charAt(0).toUpperCase() + input.substr(1).toLowerCase() : '';
    }
});

chisel.filter('dayName', function() {
    return function(time) {
        var d = new Date(time);
        var days = ['Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'];
        return day = days[d.getDay()];
    }
});
