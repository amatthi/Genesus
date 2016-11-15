<!DOCTYPE html>
<html>
	<head>
		<title>Genesus</title>
		<meta charset="utf-8" />
		<base href="/">
		<meta http-equiv="x-ua-compatible" content="ie=edge">
		<meta name="description" content="Genesus lets you create your own branded supplement line, risk free.">
		<meta name="google-site-verification" content="6y7jyyC1B4MYvTde6xD71veT8X68pG6Ub3FhudYy9XQ" />
		<meta http-equiv="Pragma" content="public">
		<meta http-equiv="Cache-Control" content="public">
		<meta http-equiv="Expires" content="Sat, 01 Dec 2018 00:00:00 GMT">
		<meta name="viewport" content="width=device-width" />
		<meta name="google-site-verification" content="pqwiId01A3wp5QfmFmK2hskliqxeOkGkcUa03aV2Loc" />
		<link rel="shortcut icon" href="/favicon.ico?v=4.0" type="image/x-icon">
		<link rel="icon" href="/favicon.ico" type="image/x-icon">
		<link href="https://fonts.googleapis.com/css?family=Dosis:300,400,500,600,700" rel="stylesheet">
		<link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:400,600" rel="stylesheet">
		<link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
		<link href="/assets/css/rzslider.min.css" rel="stylesheet">
		<link href="/assets/css/dev.css" rel="stylesheet">
		<link href="/assets/css/app.css" rel="stylesheet">
	</head>
	<body ng-app="myApp" style="background:#fff;" ng-controller="mainController">
		<div class='darken' ng-show="now_module != ''"></div>
		<div ng-include="'/html/templates/navbar.html?'+template_v"></div>
		<div id="pop-module">
			<div class="modal_actions2" ng-if="now_module == 'login'" ng-include="'/html/templates/login.html?'+template_v"></div>
			<div class="modal_actions2" ng-if="now_module == 'register'" ng-include="'/html/templates/register.html?'+template_v"></div>
			<div class="modal_actions2" ng-if="now_module == 'payment'" ng-include="'/html/templates/payment.html?'+template_v"></div>
		</div>
	<section class="innerpage" ng-view></section>
	<div class='container-fluid'>
		<div ng-include src="'/html/templates/footer.html'"></div>
	</div>
	<script>
  window.intercomSettings = {
    app_id: "ifi52d9m"
  };
</script>
<script>(function(){var w=window;var ic=w.Intercom;if(typeof ic==="function"){ic('reattach_activator');ic('update',intercomSettings);}else{var d=document;var i=function(){i.c(arguments)};i.q=[];i.c=function(args){i.q.push(args)};w.Intercom=i;function l(){var s=d.createElement('script');s.type='text/javascript';s.async=true;s.src='https://widget.intercom.io/widget/ifi52d9m';var x=d.getElementsByTagName('script')[0];x.parentNode.insertBefore(s,x);}if(w.attachEvent){w.attachEvent('onload',l);}else{w.addEventListener('load',l,false);}}})()</script>
</body>
<script type="text/javascript" src="/assets/js/app.js"></script>
<script type="text/javascript" src="https://js.stripe.com/v2/"></script>
<script type="text/javascript">
  Stripe.setPublishableKey('{{$stripe_key}}');
</script>
<script type='text/javascript'>
window.__lo_site_id = 67462;
	(function() {
		var wa = document.createElement('script'); wa.type = 'text/javascript'; wa.async = true;
		wa.src = 'https://d10lpsik1i8c69.cloudfront.net/w.js';
		var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(wa, s);
	})();
</script>
<script>
(function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
(i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
})(window,document,'script','https://www.google-analytics.com/analytics.js','ga');
ga('create', 'UA-85902217-1', 'auto');
ga('send', 'pageview');
</script>
<!-- Facebook Pixel Code -->
<script>
!function(f,b,e,v,n,t,s){if(f.fbq)return;n=f.fbq=function(){n.callMethod?
n.callMethod.apply(n,arguments):n.queue.push(arguments)};if(!f._fbq)f._fbq=n;
n.push=n;n.loaded=!0;n.version='2.0';n.queue=[];t=b.createElement(e);t.async=!0;
t.src=v;s=b.getElementsByTagName(e)[0];s.parentNode.insertBefore(t,s)}(window,
document,'script','https://connect.facebook.net/en_US/fbevents.js');
fbq('init', '199108557182124');
fbq('track', "PageView");</script>
<noscript><img height="1" width="1" style="display:none"
src="https://www.facebook.com/tr?id=199108557182124&ev=PageView&noscript=1"
/></noscript>
<!-- End Facebook Pixel Code -->
</html>
