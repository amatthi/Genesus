<!doctype html>
<html>
    <head>
        <meta charset="utf-8">
        <base href="/plugin/design/">
        <title>Genesus</title>
        <meta name="description" content="Genesus lets you create your own branded supplement line, risk free.">
        <link rel="shortcut icon" href="/favicon2.ico?v=2.0" type="image/x-icon">
        <link rel="icon" href="/favicon2.ico" type="image/x-icon">
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
                    <div class="col-xs-12 col-sm-7 col-sm-offset-1">
                        <span class="step-default" ng-class="{ 'launch-current-step' : launch_step_create() }" ng-click="set_step('create',1)"><span class="step-number-default" ng-class="{ 'step-number' : launch_step_create() }">1</span> Create</span>
                        <span class="step-default" ng-class="{ 'launch-current-step' : launch_step_goal() }" ng-click="set_step('goal',1)"><span class="step-number-default" ng-class="{ 'step-number' : launch_step_goal() }">2</span> Set a goal</span>
                        <span class="step-default" ng-class="{ 'launch-current-step' : launch_step_desc() }" ng-click="set_step('desc',1)"><span class="step-number-default" ng-class="{ 'step-number' : launch_step_desc() }">3</span> Add a description</span>
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
                <div class="container bigger-pad">
                    <h1 ng-click="test()" style="display:none;">test</h1>
                    <!-- custom -->
                    <div class='darken' ng-show="now_module != ''"></div>
                    <div ng-include="'/html/templates/navbar.html?'+template_v"></div>
                    <div id="pop-module">
                        <div class="modal_actions2" ng-if="now_module == 'login'" ng-include="'/html/templates/login.html?'+template_v"></div>
                        <div class="modal_actions2" ng-if="now_module == 'register'" ng-include="'/html/templates/register.html?'+template_v"></div>
                    </div>
                    <!-- custom END -->
                    <!-- step -->
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
    </body>
</html>
