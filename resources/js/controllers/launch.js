chisel.controller("launchController", function($scope, $rootScope, mainFactory,chisel_var) {
    $scope.launch_step = 'create';
    $scope.var = 'var is here';
    $scope.fonts = chisel_var.get('fonts');
    $scope.campaign_data = {};
    $scope.amazon_connect('tappyn');

    $scope.init = function(){
        $scope.campaign_data.font_color = '#ffffff';
        $scope.campaign_data.cap_color = '#ffffff';
        //$scope.campaign_data.art = 'https://tappyn.s3.amazonaws.com/lo_art1476026650592_42801';
    }
    $scope.init();

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

    $scope.refresh_bottle= function(){
        $("#bottle-div").css('font-family',$scope.campaign_data.font);
    }

    $scope.$on('amazon_uploaded', function(event) {
        $scope.campaign_data.art = $scope.__s.aws.file_url;
    });
});
