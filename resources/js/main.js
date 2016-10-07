var chisel = angular.module('myApp', [
    'ngRoute',
    'ui.bootstrap',
]);

chisel.config(function($routeProvider, $locationProvider,$httpProvider) {
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

    $rootScope.modal_up = false;
    $rootScope.root_modal = { now: '' };

    $scope.signing_in = { show: false, type: '', object: '' };
    $scope.registration = { show: false, type: '', object: '' };

    $scope.close_register = function() {
            $rootScope.modal_up = false;
            $scope.registration = { show: false, type: '', object: '' };
        }

});
