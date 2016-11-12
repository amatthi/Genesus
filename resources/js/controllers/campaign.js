chisel.controller("campaignController", function($scope, $rootScope, $routeParams, $location, mainFactory, chisel_var) {
    $scope.campaign_data = {};
    $scope.purchase_count = '10';
    $scope.location = '/campaign';

    $scope.get_campaign = function() {
        mainFactory.get_campaign($routeParams.slug).then(function(r) {
            $scope.campaign_data = r.data;
            $scope.campaign_data.bottle_type = 'front';
            $scope.$broadcast('timer-set-countdown', $scope.campaign_data.countdown);
            if ($scope.campaign_data.user.profile.instagram) {
                $('#my-instashow').instaShow({
                    api: '/instashow/api/',
                    source: '@' + $scope.campaign_data.user.profile.instagram,
                });
            }

        }, $scope.handle_error);
    }
    $scope.get_campaign();

    $scope.add_nutrition_path = function(formula) {
        if (!formula) return '';
        return '/plugin/design/images/nutrition_facts/' + formula.name.replace(/ /g, '_') + '.jpg';
    }

    $scope.add_side_quality = function(formula) {
        if (!formula) return '';
        return '/plugin/design/images/side_qualities/' + formula.name.replace(/ /g, '_') + '.jpg';
    }

    $scope.add_ingredient_path = function(ingredient) {
        return '/plugin/design/images/ingredients/' + ingredient.replace(/ /g, '_') + '.png';
    }

    $scope.add_benefit1_path = function(benefit_1) {
        benefit_1 = $scope.campaign_data.formula.benefit_1;
        return '/plugin/design/images/benefits_1/' + benefit_1.replace(/ /g, '_') + '.jpg';
    }

    $scope.add_benefit2_path = function(benefit_2) {
        benefit_2 = $scope.campaign_data.formula.benefit_2;
        return '/plugin/design/images/benefits_2/' + benefit_2.replace(/ /g, '_') + '.jpg';
    }

    $scope.add_benefit3_path = function(benefit_3) {
        benefit_3 = $scope.campaign_data.formula.benefit_3;
        return '/plugin/design/images/benefits_3/' + benefit_3.replace(/ /g, '_') + '.jpg';
    }

    $scope.add_benefit4_path = function(benefit_4) {
        benefit_4 = $scope.campaign_data.formula.benefit_4;
        return '/plugin/design/images/benefits_4/' + benefit_4.replace(/ /g, '_') + '.jpg';
    }

    $scope.add_benefit5_path = function(benefit_5) {
        benefit_5 = $scope.campaign_data.formula.benefit_5;
        return '/plugin/design/images/benefits_5/' + benefit_5.replace(/ /g, '_') + '.jpg';
    }

    $scope.add_benefit3_path = function(benefit_3) {
        benefit_3 = $scope.campaign_data.formula.benefit_3;
        return '/plugin/design/images/benefits_6/' + benefit_6.replace(/ /g, '_') + '.jpg';
    }

    $scope.buy_campaign = function() {
        $scope.__payment.type = 'buy_campaign';
        $scope.__payment.data = $scope.campaign_data;
        $scope.__payment.step = '1';
        $scope.__payment.email = $scope.__user.email;
        $scope.open_payment();
    }

    $scope.add_back_image_path = function(back_image) {
        return '/plugin/design/dummy_data/products/bottle/back/' + back_image;
    }

    $scope.$on('payment_done', function() {
        $scope.set_module();
        $location.path('/thank_you');
        // $scope.get_campaign();
    });
});
