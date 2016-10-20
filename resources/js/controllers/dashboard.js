chisel.controller("dashboardController", function($scope, $rootScope, $routeParams, mainFactory, chisel_var) {
    $scope.campaigns = [];
    $scope.profile_data = {};
    $scope.dash_view = 'campaigns';

    $scope.$on('is_login_done', function(event) {
    	$scope.profile_data = {};
        $scope.profile_data.email = $scope.__user.email;
        $scope.profile_data.biography = $scope.__user.profile.biography;
        $scope.profile_data.old_photo = $scope.__user.profile.photo;
    });
    $scope.is_login();

    mainFactory.dashboard_campaigns().then(function(r) {
        $scope.campaigns = r.data;
    }, $scope.handle_error);

    $scope.add_profile_photo = function() {
        var f = document.getElementById('profile-photo').files[0],
            r = new FileReader();
        r.onloadend = function(e) {
            $scope.profile_data.photo = e.target.result;
        }
        r.readAsDataURL(f);
    }
    angular.element(document.querySelector('#profile-photo')).on('change', $scope.add_profile_photo);

    $scope.update_profile = function(profile_data) {
        mainFactory.update_profile(profile_data).then(function(r) {
        	alert('update profile success');
            $scope.is_login();
        }, $scope.handle_error);
    }
});
