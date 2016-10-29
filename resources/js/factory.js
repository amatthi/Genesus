chisel.factory("mainFactory", function($http) {
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

    fact.get_campaign = function(slug) {
        return $http({
            method: 'GET',
            url: '/api/campaign/get_by_slug/' + slug,
            headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
        })
    }

    fact.get_campaign_by_id = function(id) {
        return $http({
            method: 'GET',
            url: '/api/campaign/get_by_id/' + id,
            headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
        })
    }

    fact.dashboard_campaigns = function() {
        return $http({
            method: 'GET',
            url: '/api/campaign/dashboard',
            headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
        })
    }

    fact.update_profile = function(data) {
        return $http({
            method: 'POST',
            url: '/api/profile',
            headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
            data: $.param(data)
        })
    }

    fact.pay = function(data) {
        return $http({
            method: 'POST',
            url: '/api/pay',
            headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
            data: $.param(data)
        })
    }

    fact.get_payment = function() {
        return $http({
            method: 'GET',
            url: '/api/profile/payment',
            headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
        })
    }

    fact.get_campaign_by_id = function(id) {
        return $http({
            method: 'GET',
            url: '/api/campaign/get_by_id/' + id,
            headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
        })
    }

    fact.update_campaign = function(data) {
        return $http({
            method: 'POST',
            url: '/api/campaign/' + data.id + '/update',
            headers: {
                'Content-type': 'application/x-www-form-urlencoded'
            },
            'data': $.param(data)
        });
    }
    return fact;
})
