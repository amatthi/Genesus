chisel.controller("mainController", function($scope, $rootScope, mainFactory) {
    $scope.now_module = '';
    $scope.template_v = '1.2';
    $scope.__user = {};

    $scope.set_module = function(name) {
        $scope.now_module = (name) ? name : '';
    }

    $scope.register = function(data) {
        mainFactory.register(data).then(function(r) {
            $scope.__user = r.data.user;
            $scope.set_module();
        }, $scope.handle_error);
    }

    $scope.handle_error = function(response) {
        // console.log(response);
        if (response.status == 422) {
            var data = response.data;
            for (var i in data) {
                alert(data[i]);
            }
        }
    }

    $scope.is_login = function() {
        mainFactory.is_login().then(function(r) {
            $scope.__user = (r.data.user) ? r.data.user : {};
        });
    }
    $scope.is_login();

    $scope.logout = function() {
        mainFactory.logout().then(function(r) {
            $scope.__user = {};
        }, $scope.handle_error);
    }

    $scope.login = function(data) {
        mainFactory.login(data).then(function(r) {
            $scope.__user = (r.data.user) ? r.data.user : {};
            $scope.set_module();
        }, $scope.handle_error);
    }
});
