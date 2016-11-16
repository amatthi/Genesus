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
        $scope.template_v = '1.1.4';
        $scope.now_module = '';
        $scope.login_after = '';
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

        $scope.set_module = function(name, login_after) {
            $scope.now_module = (name) ? name : '';
            $scope.login_after = (login_after) ? login_after : '';
        }
        $scope.register = function(data) {
            mainFactory.register(data).then(function(r) {
                $scope.__user = r.data.user;
                if ($scope.login_after == 'launch') {
                    $scope.submit_campaign($scope.campaign_data);
                }
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
            } //else if (response.status == 401) {
                //alert('must login');
            //}
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
                if ($scope.login_after == 'launch') {
                    $scope.submit_campaign($scope.campaign_data);
                }
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

        $scope.location = '/launch';
        $scope.launch_step = 'create';
        $scope.campaign_data = { goal: 30, cost_per_bottle: 5.75, sale_price: 39.99 };
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
                if (!$scope.campaign_data.sale_price) alert('Please enter a sale price.');
                //else if (!$scope.campaign_data.blend_name) alert('Please enter a proprietary blend name to continue.');
                else $scope.launch_step = step;
            } else if (step == 'goal') {
                if (!$scope.campaign_data.purpose) alert('Please choose one purpose.');
                else if (!$scope.campaign_data.formula) alert('Please choose one product.');
                else $scope.launch_step = step;
            } else {
                $scope.launch_step = step;
            }
        }

        $scope.submit_campaign = function(data) {
            $scope.campaign_data.png64 = $scope.fabric.saveCanvasObjectAsPng();
            // data.product_id = $scope.defaultProductId;
            // data.objectLayers = $scope.objectLayers;
            data.status = 'draft';
            data.slug = $scope.campaign_data.slug;
            mainFactory.launch_campaign(data).then(function(r) {
                //console.log(r);
                window.onbeforeunload = null;
                window.onhashchange = null;
                //alert('Your campaign is now live!');
                window.location = '/campaign/' + r.data.slug;
            }, $scope.handle_error);
        }

        mainFactory.campaign_purposes().then(function(r) {
            $scope.purposes = r.data;
            $scope.campaign_data.purpose = r.data[0];
            $scope.campaign_data.formula = r.data[0]['formulas'][0];
            $scope.check_is_update();
        });

        $scope.check_is_update = function() {
            var campaign_id = window.location.pathname.match(/\d+/);
            if (campaign_id) {
                mainFactory.get_campaign_by_id(campaign_id[0]).then(function(r) {
                    if (r.data.user_id != $scope.__user.id) {
                        alert('this campaign is not yours');
                        window.onbeforeunload = null;
                        window.onhashchange = null;
                        window.location = '/launch';
                        return;
                    }
                    $scope.campaign_data = r.data;
                    $scope.campaign_data.purpose = $scope.purposes.find(function(purpose) {
                        return purpose.key == $scope.campaign_data.purpose.key;
                    });
                    $scope.campaign_data.formula = $scope.campaign_data.purpose.formulas.find(function(formula) {
                        return formula.sku == $scope.campaign_data.formula.sku;
                    });

                    // $scope.loadProduct($scope.defaultProductTitle, $scope.defaultProductImage, $scope.defaultProductId, $scope.defaultPrice, $scope.defaultCurrency);
                }, $scope.handle_error);
            }
        }

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
            if (goal < 20) {
                bottle = Number($scope.campaign_data.formula.cost1);
            } else if (goal >= 20 && goal < 100) {
                bottle = Number($scope.campaign_data.formula.recommended_price);
            } else if (goal >= 100 && goal < 200) {
                bottle = Number($scope.campaign_data.formula.cost100);
            } else if (goal == 200) {
                bottle = Number($scope.campaign_data.formula.cost200);
            }

            return (price - bottle) * goal;
        }

        $scope.purpose_change = function() {
            $scope.campaign_data.formula = $scope.campaign_data.purpose['formulas'][0];
            $scope.formula_change();
        }

        $scope.add_back_image_path = function(back_image) {
            return 'dummy_data/products/bottle/back/' + back_image;
        }

        $scope.formula_change = function(formula) {
            $scope.campaign_data.formula = formula;
            $scope.campaign_data.sale_price = formula.recommended_price;
            if ($scope.campaign_data.formula.back_image && $scope.activeDesignObject == 1) {
                setTimeout(function() {
                    $('#bottle-back-a').trigger('click');
                }, 500);
            } else {
                $scope.loadProduct($scope.defaultProductTitle, $scope.productImages[0], $scope.defaultProductId, $scope.defaultPrice, $scope.defaultCurrency, 0);
            }
        }

        $scope.hasFormula = function(product) {
            var hide_standard = ['Pre-Workout', 'Whey Protein Isolate', 'Evolve Pure Hangover Prevention', 'Greens Complex'];
            if ((product.name == 'Template' || product.name == 'Standard Bottle') && $.inArray($scope.campaign_data.formula.name, hide_standard) == -1) {
                return true;
            }

            if ($scope.campaign_data.formula.name == product.name) {
                return true;
            }
            return false;
        }

        $scope.add_formula_path = function(formula) {
            //formula = $scope.campaign_data.formula.name;
            return 'images/formula/' + formula.name.replace(/ /g, '_') + '.jpg';
        }

        $scope.add_formula_path_2 = function(formula) {
            formula = $scope.campaign_data.formula;
            return 'images/formula/' + formula.name.replace(/ /g, '_') + '.jpg';
        }

        $scope.add_ingredient_path = function(ingredient) {
            return 'images/ingredients/' + ingredient.replace(/ /g, '_') + '.png';
        }

        $scope.add_benefit1_path = function(benefit_1) {
            benefit_1 = $scope.campaign_data.formula.benefit_1;
            return 'images/benefits_1/' + benefit_1.replace(/ /g, '_') + '.jpg';
        }

        $scope.add_benefit2_path = function(benefit_2) {
            benefit_2 = $scope.campaign_data.formula.benefit_2;
            return 'images/benefits_2/' + benefit_2.replace(/ /g, '_') + '.jpg';
        }

        $scope.add_benefit3_path = function(benefit_3) {
            benefit_3 = $scope.campaign_data.formula.benefit_3;
            return 'images/benefits_3/' + benefit_3.replace(/ /g, '_') + '.jpg';
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

        $scope.test = function(data) {
            // data.product_id = $scope.defaultProductId;
            data.objectLayers = $scope.objectLayers;
            data.status = 'draft';
            mainFactory.launch_campaign(data).then(function(r) {
                //console.log(r);
                window.onbeforeunload = null;
                window.onhashchange = null;
                alert('Your campaign is now live!');
                window.location = '/share/' + r.data.id;
            }, $scope.handle_error);
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
            url: '/api/is_login',
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

    fact.get_campaign_by_id = function(id) {
        return $http({
            method: 'GET',
            url: '/api/campaign/get_by_id/' + id,
            headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
        })
    }
    return fact;
});

chisel_launch.config(function($httpProvider) {
    $httpProvider.defaults.headers.common["X-Requested-With"] = 'XMLHttpRequest';
});
