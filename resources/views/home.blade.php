<!DOCTYPE html>
<html>
    <head>
        <title>Genesus</title>
		<meta charset="utf-8" />
		<base href="/">
		<meta http-equiv="x-ua-compatible" content="ie=edge">
		<meta name="description" content="Genesus lets you create your own branded supplement line, risk free.">
		<meta http-equiv="Pragma" content="public">
		<meta http-equiv="Cache-Control" content="public">
		<meta http-equiv="Expires" content="Sat, 01 Dec 2018 00:00:00 GMT">
		<meta name="viewport" content="width=device-width" />
    <meta name="google-site-verification" content="pqwiId01A3wp5QfmFmK2hskliqxeOkGkcUa03aV2Loc" />
		<link rel="shortcut icon" href="/favicon2.ico?v=2.0" type="image/x-icon">
		<link rel="icon" href="/favicon2.ico" type="image/x-icon">
		<link href="//fonts.googleapis.com/css?family=Roboto:100,300,400" rel="stylesheet">
		<link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
		<link href="/assets/css/dev.css" rel="stylesheet">
		<link href="/assets/css/app.css" rel="stylesheet">
	</head>
    <body ng-app="myApp" style="background:#fff;" ng-controller="mainController">
		<div class='darken' ng-show="now_module != ''"></div>
        <div ng-include="'/html/templates/navbar.html?'+template_v"></div>
        <div id="pop-module">
            <div class="modal_actions2" ng-if="now_module == 'login'" ng-include="'/html/templates/login.html?'+template_v"></div>
            <div class="modal_actions2" ng-if="now_module == 'register'" ng-include="'/html/templates/register.html?'+template_v"></div>
        </div>
    <section class="innerpage" ng-view></section>
</body>
<script type="text/javascript" src="/assets/js/app.js"></script>
<script type='text/javascript'>
window.__lo_site_id = 67462;

	(function() {
		var wa = document.createElement('script'); wa.type = 'text/javascript'; wa.async = true;
		wa.src = 'https://d10lpsik1i8c69.cloudfront.net/w.js';
		var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(wa, s);
	  })();
	</script>
</html>
