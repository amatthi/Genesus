chisel.controller("mainController", function($scope, $rootScope, mainFactory) {
    $scope.now_module = '';
    $scope.template_v = '1.1';

    $scope.set_module = function(name) {
        $scope.now_module = (name) ? name : '';
    }

    $scope.register = function(data) {
        mainFactory.register(data).then(function(r) {
        	
        }, $scope.handle_error);
    }

    $scope.handle_error = function(response) {
    	// console.log(response);
    	if(response.status == 422){
    		var data = response.data;
    		for(var i in data){
    			alert(data[i]);
    		}
    	}
    }
});
