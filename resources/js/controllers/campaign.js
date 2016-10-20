chisel.controller("campaignController", function($scope, $rootScope, $routeParams, mainFactory, chisel_var) {
    $scope.campaign_data = {};
    mainFactory.get_campaign($routeParams.slug).then(function(r) {
        $scope.campaign_data = r.data;
    }, $scope.handle_error);

    $scope.add_ingredient_path = function(ingredient) {
        return '/plugin/design/images/ingredients/' + ingredient.replace(/ /g, '_') + '.jpg';
    }

    $scope.buy_campaign = function() {
        mainFactory.buy_campaign($scope.campaign_data).then(function(r) {
            console.log(r);
        }, $scope.handle_error);
    }

});
