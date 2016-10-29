chisel.controller("shareController", function($scope, $rootScope, $routeParams, mainFactory) {
    $scope.campaign_data = {};
    $scope.get_campaign = function() {
            mainFactory.get_campaign_by_id($routeParams.id).then(function(r) {
                $scope.campaign_data = r.data;
                var s = document.createElement("script");
                s.type = "text/javascript";
                s.src = "//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-580c34729ce0967a";
                // Use any selector
                $("#addthis-script").append(s);
            }, $scope.handle_error);
        }
        //console.log($routeParams.id);
    if ($routeParams.id) {
        $scope.get_campaign();
    }
});
