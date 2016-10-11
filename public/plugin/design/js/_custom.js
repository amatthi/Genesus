chisel_launch.controller('CustomCtrl', [
    '$scope',
    'Fabric',
    'FabricConstants',
    'Keypress',
    '$http',
    '$timeout',
    '$mdDialog',
    '$mdToast',
    'Upload',
    'mainFactory',

    function($scope, Fabric, FabricConstants, Keypress, $http, $timeout, $mdDialog, $mdToast, Upload, mainFactory) {
        $scope.template_v = '1.1.0';
        var base_url = window.location.href.split('#')[0];
        $("a").each(function() {
            if ($(this).attr('href').indexOf('#') >= 0) {
                $(this).attr('href', base_url + $(this).attr('href'));
            }
        });
        $scope.now_module = '';
        $scope.template_v = '1.5';
        $scope.__user = {};
        $scope.__s = {};
        $("body").on('click', '.darken', function(event) {
            if (event.target !== this) {
                return;
            }
            $scope.set_module();
            $scope.$apply();
        });
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
        $scope.amazon_connect = function(bucket) {
            mainFactory.aws_key(bucket).success(function(r) {
                $scope.__s.aws = r;
            });
        }
        $scope.amazon_upload = function($files, arg) {
            arg = (arg) ? arg : '';
            var aws = $scope.__s.aws;
            var file = $files[0];
            var url = aws.base_url;
            var new_name = Date.now();
            var rando = Math.floor(Math.random() * 100000);
            new_name = 'lo_' + arg + new_name.toString() + '_' + rando.toString();
            $upload.upload({
                url: url,
                method: 'POST',
                data: {
                    key: new_name,
                    acl: 'public-read',
                    "Content-Type": file.type === null || file.type === '' ?
                        'application/octet-stream' : file.type,
                    AWSAccessKeyId: aws.key,
                    policy: aws.policy,
                    signature: aws.signature
                },
                file: file,
            }).success(function() {
                $scope.__s.aws.file_url = url + new_name;
                $scope.$broadcast('amazon_uploaded');
            });
        }
    }
]);
chisel_launch.factory("mainFactory", function($http) {
    var fact = {};
    fact.register = function(data) {
        return $http({
            method: 'POST',
            url: '/register',
            headers: {
                'Content-type': 'application/x-www-form-urlencoded'
            },
            'data': $.param(data)
        });
    }
    fact.is_login = function() {
        return $http({
            method: 'GET',
            url: '/is_login',
            headers: {
                'Content-type': 'application/x-www-form-urlencoded'
            }
        });
    }
    fact.logout = function() {
        return $http({
            method: 'GET',
            url: '/logout',
            headers: {
                'Content-type': 'application/x-www-form-urlencoded'
            }
        });
    }
    fact.login = function(data) {
        return $http({
            method: 'POST',
            url: '/login',
            headers: {
                'Content-type': 'application/x-www-form-urlencoded'
            },
            'data': $.param(data)
        });
    }
    fact.launch_campaign = function(data) {
        return $http({
            method: 'POST',
            url: '/api/campaign/launch',
            headers: {
                'Content-type': 'application/x-www-form-urlencoded'
            },
            'data': $.param(data)
        });
    }
    fact.aws_key = function(bucket) {
        return $http({
            method: 'POST',
            url: '/api/amazon/get_token',
            headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
            data: $.param({ bucket: bucket })
        })
    }
    return fact;
})
