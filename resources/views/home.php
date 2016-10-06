<!DOCTYPE html>
<html>
<head>
    <title>Lift Off</title>
    <meta charset="utf-8" />
    <base href="/">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="description" content="Lift Off lets you create your own branded supplement line, risk free.">
    <meta http-equiv="Pragma" content="public">
    <meta http-equiv="Cache-Control" content="public">
    <meta http-equiv="Expires" content="Sat, 01 Dec 2018 00:00:00 GMT">
    <meta name="viewport" content="width=device-width" />
    <link href="https://fonts.googleapis.com/css?family=Roboto:100,300,400" rel="stylesheet">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
    <link href="/assets/css/app.css" rel="stylesheet">
    <link rel="shortcut icon" href="/favicon2.ico?v=2.0" type="image/x-icon">
    <link rel="icon" href="/favicon2.ico" type="image/x-icon">
    <script src="public/resources/js/vendor/ui-bootstrap-tpls-0.14.3.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.4.3/angular.min.js"></script>
    <script src='//ajax.googleapis.com/ajax/libs/angularjs/1.4.3/angular-animate.js'></script>
</head>
	<body ng-app="myApp" style="background:#fff;">
    <div class='container-fluid navbar-fixed-top'>
        <div ng-include src="'templates/navbar.html'"></div>
    </div>
    <section class='innerpage' ng-view></section>
	</body>
	<script type="text/javascript" src="/assets/js/app.js"></script>
</html>
