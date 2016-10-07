chisel.controller("launchController", function($scope, $rootScope, mainFactory) {
    $scope.launch_step = 'create';
    $scope.var = 'var is here';
    $scope.campaign_data = {};

    $scope.launch_step_create = function() {
        return $scope.launch_step == 'create'
    };

    $scope.launch_step_goal = function() {
        return $scope.launch_step == 'goal'
    };

    $scope.launch_step_desc = function() {
        return $scope.launch_step == 'desc'
    };

    $scope.set_step = function(step) {
        if (false) {

        } else {
            $scope.launch_step = step;
        }
    }

    $scope.submit_campaign = function(data) {
        mainFactory.launch_campaign(data).then(function(r) {
            alert('submit_campaign complete');
        }, $scope.handle_error);
    }
});
