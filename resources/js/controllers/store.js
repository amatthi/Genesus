chisel.controller("storeController", function($scope, $rootScope, mainFactory) {
    mainFactory.campaign_purposes().then(function(r) {
        $scope.purposes = r.data;
    });

    $scope.add_formula_path = function(formula) {
        //formula = $scope.campaign_data.formula.name;
        return '/plugin/design/images/formula/' + formula.name.replace(/ /g, '_') + '.jpg';
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

    $scope.add_benefit6_path = function(benefit_6) {
        benefit_6 = $scope.campaign_data.formula.benefit_6;
        return '/plugin/design/images/benefits_6/' + benefit_6.replace(/ /g, '_') + '.jpg';
    }
});
