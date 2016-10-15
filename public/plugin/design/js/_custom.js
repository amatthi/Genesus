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
    '$timeout',

    function($scope, Fabric, FabricConstants, Keypress, $http, $timeout, $mdDialog, $mdToast, Upload, mainFactory, $timeout) {
        $scope.template_v = '1.1.2';
        $scope.now_module = '';
        $scope.__user = {};
        $scope.__s = {};
        $("body").on('click', '.darken', function(event) {
            if (event.target !== this) {
                return;
            }
            $scope.set_module();
            $scope.$apply();
        });

        $scope.goal_slider = {
            value: 30,
            options: {
            showSelectionBar: true,
            showTicksValues: true,
            stepsArray: [
                    { value: 10 },
                    { value: 20 },
                    { value: 30 },
                    { value: 40 },
                    { value: 50 },
                    { value: 100 },
                    { value: 150 },
                    { value: 200 }
                ]

            }
        };

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
            } else if (response.status == 401) {
                alert('must login');
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

        /********** launch **************/
        $scope.launch_step = 'create';
        $scope.campaign_data = { goal: 30, cost_per_bottle: 5.75, sale_price: 20.00 };
        // $scope.amazon_connect('tappyn');

        $scope.launch_step_create = function() {
            return $scope.launch_step == 'create'
        };

        $scope.launch_step_goal = function() {
            return $scope.launch_step == 'goal'
        };

        $scope.launch_step_desc = function() {
            return $scope.launch_step == 'desc'
        };


        $scope.set_step = function(step, ignore) {
            $scope.campaign_data.png64 = $scope.fabric.saveCanvasObjectAsPng();
            if (ignore) {
                $scope.launch_step = step;
            } else if (step == 'desc') {
                if (!$scope.campaign_data.sale_price) alert('enter sale price');
                else if (!$scope.campaign_data.blend_name) alert('enter Blend');
                else $scope.launch_step = step;
            } else if (step == 'goal') {
                if (!$scope.campaign_data.purpose) alert('chose one purpose');
                else if (!$scope.campaign_data.formula) alert('chose one formula');
                else $scope.launch_step = step;
            } else {
                $scope.launch_step = step;
            }
        }

        $scope.submit_campaign = function(data) {
            mainFactory.launch_campaign(data).then(function(r) {
                //console.log(r);
                window.onbeforeunload = null;
                window.onhashchange = null;
                alert('submit_campaign complete');
                window.location = '/campaign/' + r.data.slug;
            }, $scope.handle_error);
        }

        mainFactory.campaign_purposes().then(function(r) {
            $scope.purposes = r.data;
            $scope.campaign_data.purpose = r.data[0];
            $scope.campaign_data.formula = r.data[0]['formulas'][0];
        });

        $scope.$on('canvas:created', function() {
            var base_url = window.location.href.split('#')[0];
            $("a").each(function() {
                if ($(this).attr('href') && $(this).attr('href').indexOf('#') >= 0) {
                    $(this).attr('href', base_url + $(this).attr('href'));
                }
            });
        });

        $scope.estimated_profit = function() {
            if (!$scope.campaign_data.formula) return 0;
            var price = Number($scope.campaign_data.sale_price);
            var bottle = Number($scope.campaign_data.formula.cost30);
            var goal = Number($scope.campaign_data.goal);

            return (price - bottle) * goal;
        }

        $scope.purpose_change = function() {
            $scope.campaign_data.formula = $scope.campaign_data.purpose['formulas'][0];
            $scope.formula_change();
        }

        $scope.add_back_image_path = function(back_image) {
            return 'dummy_data/products/bottle/back/' + back_image;
        }

        $scope.formula_change = function() {
            if ($scope.campaign_data.formula.back_image && $scope.activeDesignObject == 1) {
                $scope.loadProduct($scope.defaultProductTitle, $scope.add_back_image_path($scope.campaign_data.formula.back_image), $scope.defaultProductId, $scope.defaultPrice, $scope.defaultCurrency, 1);
            }
            else{
                $scope.loadProduct($scope.defaultProductTitle, $scope.productImages[0], $scope.defaultProductId, $scope.defaultPrice, $scope.defaultCurrency, 0);
            }
        }

        $scope.test = function() {
            $scope.campaign_data.purpose = 'reen-coffee-bean-extract';
            console.log($scope.campaign_data);
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
    fact.campaign_purposes = function() {
        return $http({
            method: 'GET',
            url: '/api/campaign/purposes',
            headers: {
                'Content-type': 'application/x-www-form-urlencoded'
            }
        });
    }
    return fact;
})
