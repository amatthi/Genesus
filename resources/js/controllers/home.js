chisel.controller("homeController", function($scope, $rootScope, mainFactory) {
    mainFactory.campaign_purposes().then(function(r) {
        $scope.purposes = r.data;
    });

    $scope.add_label_path = function(formula) {
        //formula = $scope.campaign_data.formula.name;
        return '/plugin/design/images/labels/' + formula.name.replace(/ /g, '_') + '.jpg';
    }
});
