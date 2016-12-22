chisel.controller("dashboardController", function($scope, $rootScope, $routeParams, mainFactory, chisel_var) {
    $scope.campaigns = [];
    $scope.profile_data = {};
    $scope.campaign_data = {};
    $scope.dash_view = 'campaigns';

    $scope.$on('is_login_done', function(event) {
        $scope.profile_data = {};
        $scope.profile_data.email = $scope.__user.email;
        $scope.profile_data.biography = $scope.__user.profile.biography;
        $scope.profile_data.old_photo = $scope.__user.profile.photo;
        $scope.profile_data.brand_name = $scope.__user.profile.brand_name;
        $scope.profile_data.brand_city = $scope.__user.profile.brand_city;
        $scope.profile_data.brand_state = $scope.__user.profile.brand_state;
        $scope.profile_data.brand_zip = $scope.__user.profile.brand_zip;
        $scope.profile_data.website = $scope.__user.profile.website;
        $scope.profile_data.last_name = $scope.__user.profile.last_name;
        $scope.profile_data.career = $scope.__user.profile.career;
        $scope.profile_data.instagram = $scope.__user.profile.instagram;
        $scope.profile_data.facebook = $scope.__user.profile.facebook;
        $scope.profile_data.twitter = $scope.__user.profile.twitter;
    });
    $scope.is_login();

    $scope.get_dashboard_campaigns = function() {
        mainFactory.dashboard_campaigns().then(function(r) {
            $scope.campaigns = r.data;
        }, $scope.handle_error);
    }
    $scope.get_dashboard_campaigns();

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
            alert('Your profile has been updated!');
            $scope.is_login();
        }, $scope.handle_error);
    }

    $scope.dash_set = function(view, campaign_data) {
        $scope.dash_view = view;
        if (view == 'edit' && campaign_data) {
            $scope.campaign_data = campaign_data;
        }
    }

    $scope.getTotal = function(){
    var total = 0;
    for(var i = 0; i < $scope.campaigns.length; i++){
        var campaign = $scope.campaigns[i];
        total += (campaign.goal_count * campaign.sale_price);
        }
    return total;
    }

    $scope.getProducts = function(){
    var totalProducts = 0;
    for(var i = 0; i < $scope.campaigns.length; i++){
        var campaign = $scope.campaigns[i];
        totalProducts += campaign.goal_count;
        }
    return totalProducts;
    }

    $scope.update_campaign = function(data) {
        mainFactory.update_campaign(data).then(function(r) {
            alert('Your campaign has been updated!');
            $scope.get_dashboard_campaigns();
        }, $scope.handle_error);
    }
});
