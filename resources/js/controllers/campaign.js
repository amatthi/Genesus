chisel.controller("campaignController", function($scope, $rootScope, $routeParams, mainFactory, chisel_var) {
    $scope.campaign_data = {};

    $scope.get_campaign = function() {
        mainFactory.get_campaign($routeParams.slug).then(function(r) {
            $scope.campaign_data = r.data;
            $scope.campaign_data.bottle_type = 'front';
            $scope.$broadcast('timer-set-countdown', $scope.campaign_data.countdown);
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

    $scope.add_back_image_path = function(back_image) {
        return '/plugin/design/dummy_data/products/bottle/back/' + back_image;
    }

    $scope.$on('payment_done', function() {
        $scope.set_module();
        alert('buy campaign complete!');
        $scope.get_campaign();
    });
});
