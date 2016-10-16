chisel.controller("dashboardController", function($scope, $rootScope, $routeParams, mainFactory, chisel_var) {
    $scope.campaigns = [];
    
    mainFactory.dashboard_campaigns().then(function(r){
    	$scope.campaigns = r.data;
    }, $scope.handle_error);
});
