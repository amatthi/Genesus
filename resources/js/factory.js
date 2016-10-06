chisel.factory("mainFactory", function($http) {
    var fact = {};

    fact.register = function(data) {
        return $http({
            method: 'POST',
            url: '/register',
            headers: {
                'Content-type': 'application/x-www-form-urlencoded',
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            'data': $.param(data)
        });
    }
    return fact;
})
