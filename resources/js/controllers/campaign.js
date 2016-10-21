chisel.controller("campaignController", function($scope, $rootScope, $routeParams, mainFactory, chisel_var) {
    $scope.campaign_data = {};

    $scope.get_campaign = function() {
        mainFactory.get_campaign($routeParams.slug).then(function(r) {
            $scope.campaign_data = r.data;
        }, $scope.handle_error);
    }
    $scope.get_campaign();


    $scope.add_ingredient_path = function(ingredient) {
        return '/plugin/design/images/ingredients/' + ingredient.replace(/ /g, '_') + '.jpg';
    }

    $scope.buy_campaign = function() {
        $scope.__payment.type = 'buy_campaign';
        $scope.__payment.data = $scope.campaign_data;
        $scope.open_payment();
    }

    $scope.$on('payment_done', function() {
        $scope.set_module();
        alert('buy campaign complete!');
        $scope.get_campaign();
    });
});
