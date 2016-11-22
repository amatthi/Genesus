<!doctype html>
<html>
    <head>
        <meta charset="utf-8">
        <base href="/plugin/design/">
        <title>Genesus</title>
        <meta name="description" content="Genesus lets you create your own branded supplement line, risk free.">
        <link rel="shortcut icon" href="/favicon.ico?v=5.0" type="image/x-icon">
        <link rel="icon" href="/favicon.ico" type="image/x-icon">
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
        <meta name="google-site-verification" content="pqwiId01A3wp5QfmFmK2hskliqxeOkGkcUa03aV2Loc" />
        <link href='//fonts.googleapis.com/css?family=Lato:400,300|Lobster|Architects+Daughter|Roboto|Oswald|Montserrat|Lora|PT+Sans|Ubuntu|Roboto+Slab|Fjalla+One|Indie+Flower|Playfair+Display|Poiret+One|Dosis|Oxygen|Lobster|Play|Shadows+Into+Light|Pacifico|Dancing+Script|Kaushan+Script|Gloria+Hallelujah|Black+Ops+One|Lobster+Two|Satisfy|Pontano+Sans|Domine|Russo+One|Handlee|Courgette|Special+Elite|Amaranth|Vidaloka' rel='stylesheet' type='text/css'>
        <!-- CSS Start -->
        <link rel="stylesheet" type="text/css" href="css/select.css">
        <link rel="stylesheet" type="text/css" href="css/font-awesome.min.css" >
        <link rel="stylesheet" type="text/css" href="css/normalize.css" >
        <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css" >
        <link rel="stylesheet" type="text/css" href="css/ng-scrollbar.min.css" >
        <link rel="stylesheet" type="text/css" href="css/style.css" >
        <link rel="stylesheet" type="text/css" href="css/custom.css" >
        <link rel="stylesheet" type="text/css" href="css/fonts.css" >
        <link rel="stylesheet" type="text/css" href="css/bootstrap-colorpicker.min.css">
        <link rel="stylesheet" type="text/css" href="css/angular-material.css">
        <link rel="stylesheet" type="text/css" href="css/rzslider.min.css">
        <!-- CSS End -->
        <link href="/assets/css/dev.css" rel="stylesheet">
        <link href="/assets/css/app.css" rel="stylesheet">
        <script type="text/javascript" src="js/jquery.js"></script>
        <script type="text/javascript" src="js/bootstrap.min.js"></script>
    </head>
    <body>
        <div class="container-fluid ng-scope" ng-controller="ProductCtrl" ng-app="productApp" id="productApp">
            <div ng-controller="CustomCtrl">
                <div class="col-xs-12 up-down-pad">
                    <div class="col-xs-12 col-sm-7">
                        <span class="step-default" ng-class="{ 'launch-current-step' : launch_step_create() }" ng-click="set_step('create',1)"><span class="step-number-default" ng-class="{ 'step-number' : launch_step_create() }">1</span> Create</span>
                        <span class="step-default" ng-class="{ 'launch-current-step' : launch_step_goal() }" ng-click="set_step('goal',1)"><span class="step-number-default" ng-class="{ 'step-number' : launch_step_goal() }">2</span> Details</span>
                        <span class="step-default" ng-class="{ 'launch-current-step' : launch_step_desc() }" ng-click="set_step('desc',1)"><span class="step-number-default" ng-class="{ 'step-number' : launch_step_desc() }">3</span> Checkout</span>
                    </div>
                    <div class="col-xs-12 col-sm-3">
                        <span class="step-default">
                            <a ng-show="__user.email" ng-click="submit_campaign(campaign_data)">
                                <span class="glyphicon glyphicon-save" aria-hidden="true"></span> Save
                            </a>
                            <a ng-show="!__user.email" ng-click="set_module('login','launch')">
                                <span class="glyphicon glyphicon-save" aria-hidden="true"></span> Save
                            </a>
                        </span>
                    </div>
                </div>
                    <h1 ng-click="test()" style="display:none;">test</h1>
                    <!-- custom -->
                    <div class='darken' ng-show="now_module != ''"></div>
                    <div ng-include="'/html/templates/navbar_sell.html?'+template_v"></div>
                    <div id="pop-module">
                        <div class="modal_actions2" ng-if="now_module == 'login'" ng-include="'/html/templates/login.html?'+template_v"></div>
                        <div class="modal_actions2" ng-if="now_module == 'register'" ng-include="'/html/templates/register.html?'+template_v"></div>
                    </div>
                    <!-- custom END -->
                    <!-- step -->
                    <div class="col-xs-12">
                    <div class="container-fluid lil-pad">
                    <div ng-include="'/html/templates/launch/step_left.html?'+template_v"></div>
                    <!-- step END -->
                    <!-- bottle -->
                    <div class="bottle-img col-xs-12 col-sm-5" ng-if="campaign_data.png64 && !launch_step_create()"><img ng-src="{{campaign_data.png64}}"></div>
                    <div class="col-xs-12 col-sm-9 bottle-design" ng-show="launch_step_create()" ng-include="'/html/templates/launch/bottle.html?'+template_v"></div>
                    <!-- bottle END -->
                    <!-- step -->
                    <div class="col-xs-12 col-sm-3" ng-include="'/html/templates/launch/step_right.html?'+template_v"></div>
                    <!-- step END -->
                </div>
              </div>
            </div>
        </div>
        <script src="assets/angular.js"></script>
        <script src="js/ui-bootstrap-tpls-0.14.3.min.js"></script>
        <script src="assets/rzslider.min.js"></script>
        <script src="assets/select.js"></script>
        <script src="assets/angular-animate.js"></script>
        <script src="assets/angular-aria.js"></script>
        <script src="assets/angular-material.js"></script>
        <script src="assets/ng-file-upload/angular-file-upload.js"></script>
        <script src="assets/ng-file-upload/angular-file-upload-shim.js"></script>
        <script type="text/javascript" src="assets/qr-code/raphael-2.1.0-min.js"></script>
        <script type="text/javascript" src="assets/qr-code/qrcodesvg.js"></script>
        <script src='assets/word-cloud/d3.v3.min.js'></script>
        <script src='assets/word-cloud/d3.layout.cloud.js'></script>
        <script src="assets/angular-sanitize.min.js"></script>
        <script src="assets/ng-scrollbar.min.js"></script>
        <script src="assets/fabric/fabric.js"></script>
        <script src="assets/fabric/fabric.min.js"></script>
        <script src="assets/fabric/fabricCanvas.js"></script>
        <script src="assets/fabric/fabricConstants.js"></script>
        <script src="assets/fabric/fabricDirective.js"></script>
        <script src="assets/fabric/fabricDirtyStatus.js"></script>
        <script src="assets/fabric/fabricUtilities.js"></script>
        <script src="assets/fabric/fabricWindow.js"></script>
        <script src="assets/fabric/fabric.curvedText.js"></script>
        <script src="assets/fabric/fabric.customiseControls.js"></script>
        <script src="assets/colorpicker/bootstrap-colorpicker-module.js"></script>
        <script src="js/application.js"></script>
        <script src="js/_custom.js"></script>
        <script src="assets/file/fileSaver.js"></script>
        <script src="assets/pdf/jspdf.debug.js"></script>
        <div id="qrcode"></div>
        <div id="wordcloud"></div>
        <div class="css_gen"></div>
        <div class="svgElements"></div>
        <script>
  window.intercomSettings = {
    app_id: "ifi52d9m"
  };
</script>
<script>(function(){var w=window;var ic=w.Intercom;if(typeof ic==="function"){ic('reattach_activator');ic('update',intercomSettings);}else{var d=document;var i=function(){i.c(arguments)};i.q=[];i.c=function(args){i.q.push(args)};w.Intercom=i;function l(){var s=d.createElement('script');s.type='text/javascript';s.async=true;s.src='https://widget.intercom.io/widget/ifi52d9m';var x=d.getElementsByTagName('script')[0];x.parentNode.insertBefore(s,x);}if(w.attachEvent){w.attachEvent('onload',l);}else{w.addEventListener('load',l,false);}}})()</script>
    </body>
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
