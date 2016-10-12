chisel.controller("campaignController", function($scope, $rootScope,$routeParams, mainFactory, chisel_var) {
    $scope.campaign_data = {};
    mainFactory.get_campaign($routeParams.slug).then(function(r) {
        $scope.campaign_data = r.data;
    }, $scope.handle_error);

});
