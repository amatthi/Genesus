chisel.controller("homeController", function($scope, $rootScope, mainFactory) {
    mainFactory.campaign_purposes().then(function(r) {
        $scope.purposes = r.data;
    });
});
