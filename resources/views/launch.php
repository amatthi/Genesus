<!doctype html>
<html>
    <head>
        <meta charset="utf-8">
        <base href="/plugin/design/">
        <title>Lift Off</title>
        <meta name="description" content="Lift Off lets you create your own branded supplement line, risk free.">
        <link rel="shortcut icon" href="/favicon2.ico?v=2.0" type="image/x-icon">
        <link rel="icon" href="/favicon2.ico" type="image/x-icon">
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
        <link href='//fonts.googleapis.com/css?family=Lato:400,300|Lobster|Architects+Daughter|Roboto|Oswald|Montserrat|Lora|PT+Sans|Ubuntu|Roboto+Slab|Fjalla+One|Indie+Flower|Playfair+Display|Poiret+One|Dosis|Oxygen|Lobster|Play|Shadows+Into+Light|Pacifico|Dancing+Script|Kaushan+Script|Gloria+Hallelujah|Black+Ops+One|Lobster+Two|Satisfy|Pontano+Sans|Domine|Russo+One|Handlee|Courgette|Special+Elite|Amaranth|Vidaloka' rel='stylesheet' type='text/css'>
        <!-- CSS Start -->
        <link rel="stylesheet" type="text/css" href="css/font-awesome.min.css" >
        <link rel="stylesheet" type="text/css" href="css/normalize.css" >
        <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css" >
        <link rel="stylesheet" type="text/css" href="css/ng-scrollbar.min.css" >
        <link rel="stylesheet" type="text/css" href="css/style.css" >
        <link rel="stylesheet" type="text/css" href="css/custom.css" >
        <link rel="stylesheet" type="text/css" href="css/fonts.css" >
        <link rel="stylesheet" type="text/css" href="css/bootstrap-colorpicker.min.css">
        <link rel="stylesheet" type="text/css" href="css/angular-material.css">
        <!-- CSS End -->
        <link href="/assets/css/dev.css" rel="stylesheet">
        <link href="/assets/css/app.css" rel="stylesheet">
        <script type="text/javascript" src="js/jquery.js"></script>
        <script type="text/javascript" src="js/bootstrap.min.js"></script>
    </head>
    <body>
        <div class="container-fluid">
    <div class="col-xs-12 up-down-pad">
        <div class="col-xs-12 col-sm-7 col-sm-offset-1">
            <span class="step-default" ng-class="{ 'launch-current-step' : launch_step = 'create' }"><span class="step-number-default" ng-class="{ 'step-number' : launch_step = 'create' }">1</span> Create</span>
            <span class="step-default" ng-class="{ 'launch-current-step' : launch_step = 'goal' }"><span class="step-number-default" ng-class="{ 'step-number' : launch_step = 'goal' }">2</span> Set a goal</span>
            <span class="step-default" ng-class="{ 'launch-current-step' : launch_step = 'desc' }"><span class="step-number-default" ng-class="{ 'step-number' : launch_step = 'desc' }">3</span> Add a description</span>
        </div>
        <div class="col-xs-12 col-sm-3">
            <span class="step-default">

                    <span class="glyphicon glyphicon-save" aria-hidden="true"></span> Save

            </span>
        </div>
    </div>
    </div>
        <div class="container-fluid lil-pad">
        <div class="container ng-scope" ng-controller="ProductCtrl" ng-app="productApp" id="productApp">
            <div ng-controller="CustomCtrl">
                <!-- custom -->
                <div class='darken' ng-show="now_module != ''"></div>
                <div ng-include="'/html/templates/navbar.html?'+template_v"></div>
                <div id="pop-module">
                    <div class="modal_actions2" ng-if="now_module == 'login'" ng-include="'/html/templates/login.html?'+template_v"></div>
                    <div class="modal_actions2" ng-if="now_module == 'register'" ng-include="'/html/templates/register.html?'+template_v"></div>
                </div>

                <!-- custom END -->
                <div ng-show="loading" class="loading">
                    <h1 class="lodingMessage">Initializing Design Tool<img src="images/ajax-loader.gif"></h1>
                </div>
                <div class="row clearfix" ng-cloak>
                    <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12 editor_section" ng-show="launch_step = 'create'">
                        <div id="content" class="tabing">
                            <ul id="tabs" class="nav nav-tabs" data-tabs="tabs">
                                <!--<li class="active"><a ng-click="deactivateAll()" href="#Products" class="products" data-toggle="tab"><i class="glyphicon glyphicon-shopping-cart"></i>Products</a></li>-->
                                <li><a ng-click="deactivateAll()" href="#Graphics" class="graphics" data-toggle="tab"><i class="glyphicon glyphicon-camera"></i>Graphics</a></li>
                                <li class="active"><a ng-click="addTextByAction()" href="#Text" class="text" data-toggle="tab"><i class="glyphicon glyphicon-text-size"></i>Text</a></li>
                            </ul>
                            <div id="my-tab-content" class="tab-content action_tabs">
                                <!--<div class="tab-pane active clearfix" id="Products">
                                    <h1>Products</h1>
                                    <div class="col-lg-12">
                                        <md-input-container>
                                        <label>Sort by category</label>
                                        <md-select ng-model="productCategory">
                                        <md-option ng-repeat="productCategory in productCategories" value="{{productCategory}}" ng-click="prodctByCat(productCategory);">{{productCategory}}</md-option>
                                        </md-select>
                                        </md-input-container>
                                    </div>
                                    <div class="col-lg-12 thumb_listing">
                                        <ul>
                                            <li ng-repeat="prod in products | orderBy:predicate:reverse" ng-class="(defaultProductId == prod.id) ? 'selected' : ''" ng-if="hasCategory(prod)">
                                                <a href="javascript:void(0);" ng-click="loadProduct(prod.name, prod.image, prod.id, prod.price, prod.currency);">
                                                <img data-ng-src="{{prod.image}}" alt=""></a>
                                                <span class="product_cat">{{prod.category}}</span>
                                                <span class="product_title">{{prod.name}}</span>
                                                <span class="product_price">{{prod.price}} {{prod.currency}}</span>
                                            </li>
                                        </ul>
                                    </div>
                                </div>-->
                                <div class="tab-pane clearfix" id="Graphics">
                                    <div class="graphic_options clearfix">
                                        <ul>
                                            <li class="col-lg-3 col-md-3 col-sm-6 col-xs-6 active">
                                                <div>
                                                    <a class="" href="#clip_arts" aria-controls="clip_arts" role="tab" data-toggle="tab" ng-click="exitDrawing()">
                                                        <i class="fa fa-camera-retro"></i>
                                                        <span>Art works</span>
                                                    </a>
                                                </div>
                                            </li>
                                            <li class="col-lg-3 col-md-3 col-sm-6 col-xs-6">
                                                <div>
                                                    <a class="" href="#upload_own" aria-controls="upload_own" role="tab" data-toggle="tab" ng-click="exitDrawing()">
                                                        <i class="fa fa-cloud-upload"></i>
                                                        <span>Upload own</span>
                                                    </a>
                                                </div>
                                            </li>
                                            <!--<li class="col-lg-3 col-md-3 col-sm-6 col-xs-6">
                                                <div>
                                                    <a class="" href="#qr_code" aria-controls="qr_code" role="tab" data-toggle="tab" ng-click="exitDrawing()">
                                                        <i class="fa fa-qrcode"></i>
                                                        <span>Qr code</span>
                                                    </a>
                                                </div>
                                            </li>-->
                                            <li class="col-lg-3 col-md-3 col-sm-6 col-xs-6">
                                                <div>
                                                    <a class="" href="#hand_draw" aria-controls="hand_draw" role="tab" data-toggle="tab" ng-click="enterDrawing();">
                                                        <i class="fa fa-pencil-square-o"></i>
                                                        <span>Hand draw</span>
                                                    </a>
                                                </div>
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="tab-content">
                                        <div role="tabpanel" class="tab-pane fade in active" id="clip_arts">
                                            <div class="graphic_types clearfix" ng-show="!graphic_icons">
                                                <div ng-repeat="graphicsCategory in graphicsCategories" value="{{graphicsCategory}}"  ng-click="loadByGraphicsCat(graphicsCategory)" ng-model="graphicsCategory" >
                                                    <div class="{{graphicsCategory.split(' ').join('') | lowercase}}" ></div>
                                                    <span>
                                                        {{graphicsCategory}}
                                                    </span>
                                                </div>
                                            </div>
                                            <span ng-show="graphic_icons" class="back_to_graphic" ng-click="ShowGraphicIcons()">
                                                <i class="fa fa-angle-left"></i> Back
                                            </span>
                                            <div class="graphic_icons" ng-show="graphic_icons">
                                                <div class="cal-lg-12 filter_by_cat">
                                                    <md-input-container style="">
                                                    <label>Sort by category</label>
                                                    <md-select ng-model="graphicsCategory" ng-change="loadByGraphicsCategory();">
                                                    <md-option ng-repeat="graphicsCategory in graphicsCategories" value="{{graphicsCategory}}">{{graphicsCategory}}</md-option>
                                                    </md-select>
                                                    </md-input-container>
                                                </div>
                                                <div class="col-lg-12 thumb_listing scrollme" rebuild-on="rebuild:me" ng-scrollbar is-bar-shown="barShown" ng-class="fabric.selectedObject ? 'activeControls' : ''">
                                                    <ul>
                                                        <li ng-repeat="graphic in graphics"><a href="javascript:void(0);" ng-click='addShape(graphic)'><img data-ng-src="{{graphic}}" alt="" width="120px;"></a></li>
                                                    </ul>
                                                    <a ng-if="loadMore" class="loadMore" ng-click="graphics_load_more(graphicsPage)">Load More</a>
                                                    <div class="clearfix"></div>
                                                </div>
                                            </div>
                                        </div>
                                        <div role="tabpanel" class="tab-pane fade" id="upload_own">
                                            <div class="col-lg-12 thumb_listing">
                                                <div class="well" >
                                                    <form name="myForm">
                                                        <div class="fileUpload btn btn-primary">
                                                            <span>Choose File</span>
                                                            <input type="file" ngf-select="onFileSelect(picFile);" ng-model="picFile" name="file" accept="image/*" ngf-max-size="2MB" class="upload">
                                                        </div>
                                                        <input id="uploadFile" placeholdFile NameName disabled="disabled" />
                                                        <span class="has-error" ng-show="myForm.file.$error.maxSize">File too large {{picFile.size / 1000000|number:1}}MB: max 2M</span>
                                                        <div class="clearfix"></div>
                                                        <span class="has-error" ng-show="myForm.file.$error.maxWidth">File width too large : Max Width 300px</span>
                                                        <div class="clearfix"></div>
                                                        <span class="has-error" ng-show="myForm.file.$error.maxHeight">File height too large : Max Height 300px</span>
                                                        <div class="clearfix"></div>
                                                        <span class="has-error" ng-show="uploadErrorMsg">{{uploadErrorMsg}}</span>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                        <div role="tabpanel" class="tab-pane fade" id="qr_code">
                                            <div class="col-lg-12 thumb_listing">
                                                <div class="well" >
                                                    <div class="row form-group">
                                                        <md-input-container flex>
                                                        <label>Enter website link or text here</label>
                                                        <textarea  columns="1" id="textarea-text-qr-code" ng-model="fabric.selectedObject.textQRCode"></textarea>
                                                        </md-input-container>
                                                        <div class="clearfix">
                                                            <md-button class="md-raised md-cornered" ng-click="addQRCode(fabric.selectedObject.textQRCode);" aria-label="Add QR Code"><i class="fa fa-plus"></i>&nbsp;&nbsp;Add QR Code</md-button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div role="tabpanel" class="tab-pane fade" id="hand_draw">
                                            <div class="col-lg-12 thumb_listing">
                                                <div class="well" >
                                                    <div class="row form-group">
                                                        <md-radio-group ng-model="drawing_mode_selector" ng-if="enter_drawing_mode == 'Cancel Drawing Mode'">
                                                        <md-radio-button value="Pencil" class="md-primary" ng-click="changeDrawingMode('Pencil');">Pencil</md-radio-button>
                                                        <md-radio-button value="Circle" class="md-primary" ng-click="changeDrawingMode('Circle');"> Circle </md-radio-button>
                                                        <md-radio-button value="Spray" class="md-primary" ng-click="changeDrawingMode('Spray');">Spray</md-radio-button>
                                                        <md-radio-button value="Pattern" class="md-primary" ng-click="changeDrawingMode('Pattern');">Pattern</md-radio-button>
                                                        <md-radio-button value="hline" class="md-primary" ng-click="changeDrawingMode('hline');">H-line</md-radio-button>
                                                        <md-radio-button value="vline" class="md-primary" ng-click="changeDrawingMode('vline');">V-line</md-radio-button>
                                                        <md-radio-button value="square" class="md-primary" ng-click="changeDrawingMode('square');">Square</md-radio-button>
                                                        <md-radio-button value="diamond" class="md-primary" ng-click="changeDrawingMode('diamond');">Diamond</md-radio-button>
                                                        </md-radio-group>
                                                    </div>
                                                    <br /><br />
                                                    <div class="col-sm-12 input-group colorPicker2" ng-if="enter_drawing_mode == 'Cancel Drawing Mode'">
                                                        <md-input-container flex>
                                                        <label for="Line color">Line color:</label>
                                                        <input type="text" value="" class="" colorpicker ng-model="drawing_color" ng-change="fillDrawing(drawing_color);"/>
                                                        </md-input-container>
                                                        <span class="input-group-addon" style="border: medium none #000000; background-color: {{drawing_color}}"><i></i></span>
                                                    </div>
                                                    <br />
                                                    <div class="row form-group handtool">
                                                        <md-input-container flex ng-if="enter_drawing_mode == 'Cancel Drawing Mode'">
                                                        <label for="Line width">Line width:</label>
                                                        <input class='col-sm-12' title="Line width" type='range' min="0" max="150" step=".01" ng-model="drawing_line_width" ng-change="changeDrawingWidth(drawing_line_width);"/>
                                                        </md-input-container>
                                                    </div>
                                                    <div class="row form-group handtool">
                                                        <md-input-container flex ng-if="enter_drawing_mode == 'Cancel Drawing Mode'">
                                                        <label for="Line shadow">Line shadow:</label>
                                                        <input class='col-sm-12' title="Line shadow" type='range' min="0" max="50" step=".01" ng-model="drawing_line_shadow" ng-change="changeDrawingShadow(drawing_line_shadow);"/>
                                                        </md-input-container>
                                                    </div>
                                                    <div class="row form-group">
                                                        <div class="clearfix">
                                                            <center><md-button class="md-raised md-cornered" ng-click="enterDrawingMode();" aria-label="{{enter_drawing_mode}}"><i class="fa fa-plus"></i>&nbsp;&nbsp;{{enter_drawing_mode}}</md-button></center>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane active clearfix" id="Text">
                                    <div class="graphic_options clearfix">
                                        <ul>
                                            <li class="col-lg-6 col-md-6 col-sm-6 col-xs-6 active">
                                                <div>
                                                    <a href="#text_design" aria-controls="text_design" role="tab" data-toggle="tab">
                                                        <i class="fa fa-font"></i>
                                                        <span>Text Design</span>
                                                    </a>
                                                </div>
                                            </li>
                                            <li class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
                                                <div>
                                                    <a href="#word_cloud" aria-controls="word_cloud" role="tab" data-toggle="tab">
                                                        <i class="fa fa-cloud"></i>
                                                        <span>Word Cloud</span>
                                                    </a>
                                                </div>
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="tab-content">
                                        <div role="tabpanel" class="tab-pane fade in active" id="text_design">
                                            <div class="col-lg-12 thumb_listing">
                                                <div class="well" >
                                                    <div class="row form-group">
                                                        <md-input-container flex>
                                                        <label>Enter text below</label>
                                                        <textarea  columns="1" id="textarea-text" style="text-align: {{ fabric.selectedObject.textAlign }}" ng-model="fabric.selectedObject.text"></textarea>
                                                        </md-input-container>
                                                        <div class="clearfix">
                                                            <md-button class="md-raised md-cornered" ng-click="addText()" aria-label="Add Text"><i class="fa fa-plus"></i>&nbsp;&nbsp;Add Text</md-button>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="clearfix"></div>
                                            </div>
                                        </div>
                                        <div role="tabpanel" class="tab-pane fade" id="word_cloud">
                                            <div class="col-lg-12 thumb_listing">
                                                <div class="well" >
                                                    <div class="row form-group">
                                                        <md-input-container flex>
                                                        <label>Enter words below</label>
                                                        <textarea  columns="1" id="textarea-text-word-cloud" style="text-align: {{ fabric.selectedObject.textAlign }}" ng-model="fabric.selectedObject.textWordCloud"></textarea>
                                                        </md-input-container>
                                                        <div class="clearfix">
                                                            <md-button class="md-raised md-cornered" ng-click="addWordCloud()" aria-label="Add Word Cloud"><i class="fa fa-plus"></i>&nbsp;&nbsp;Add Word Cloud</md-button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane clearfix" id="Layers">
                                    <h1>Layers</h1>
                                    <div class="col-lg-12 layer_listing scrollme" rebuild-on="rebuild:layer" ng-scrollbar is-bar-shown="barShown">
                                        <ul class="ul_layer_canvas row">
                                            <li ng-repeat="layer in objectLayers" class="ng-scope">
                                                <span>{{layer.id}}</span>
                                                <img ng-src="{{layer.src}}" alt=""/>
                                                <div class="f-right inner">
                                                    <ul class="ulInner actions">
                                                        <li class="liActions"><a href="javascript:void(0)" ng-click="deleteObject(layer.object);"><i class="fa fa-trash"></i></a></li>
                                                        <li class="liActions"><a href="javascript:void(0)" ng-click="objectForwardSwap(layer.object);"><i class="fa fa-chevron-up"></i></a></li>
                                                        <li class="liActions"><a href="javascript:void(0)" ng-click="objectBackwordSwap(layer.object);"><i class="fa fa-chevron-down"></i></a></li>
                                                        <li class="liActions"><a href="javascript:void(0)" ng-click="lockLayerObject(layer.object);"><i class="fa" ng-class="isObjectLocked(layer.object) ? 'fa-lock' : 'fa-unlock'"></i></a></li>
                                                    </ul>
                                                </div>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-12" ng-class="fabric.selectedObject ? 'activeControlsElem' : ''" ng-if='fabric.selectedObject.type' ng-switch='fabric.selectedObject.type'>
                            <div class="close-circle"><i class="fa fa-angle-left" ng-click="deactivateAll();"><span>Back</span></i></div>
                            <div class="well">
                                <div class="row form-group" ng-show="fabric.selectedObject.type == 'text' || fabric.selectedObject.type == 'curvedText'">
                                    <md-input-container flex>
                                    <label>Enter text below</label>
                                    <textarea  columns="1" id="textarea-text" style="text-align: {{ fabric.selectedObject.textAlign }}" ng-model="fabric.selectedObject.text"></textarea>
                                    </md-input-container>
                                </div>
                                <div class="row form-group" ng-show="fabric.selectedObject.type == 'text' || fabric.selectedObject.type == 'curvedText'" style="position: relative;">
                                    <md-button class="md-raised md-cornered dropdown-toggle" data-toggle="dropdown" aria-label="Font Family"><span class='object-font-family-preview' style='font-family: "{{ fabric.selectedObject.fontFamily }}";'> {{ fabric.selectedObject.fontFamily }} </span> <span class="caret"></span></md-button>
                                    <ul class="dropdown-menu">
                                        <li ng-repeat='font in FabricConstants.fonts' ng-click='toggleFont(font.name);' style='font-family: "{{ font.name }}";'> <a>{{ font.name }}</a> </li>
                                    </ul>
                                </div>
                                <div class="row row-margin">
                                    <div class="row col-lg-6" title="Font size" ng-show="fabric.selectedObject.type == 'text' || fabric.selectedObject.type == 'curvedText'">
                                        <md-input-container flex>
                                        <label><i class="fa fa-text-height"></i> (Font size)</label>
                                        <input type='number' class="" ng-model="fabric.selectedObject.fontSize" />
                                        </md-input-container>
                                    </div>
                                    <div class="row col-lg-6" title="Line height" ng-show="fabric.selectedObject.type == 'text'">
                                        <md-input-container flex>
                                        <label><i class="fa fa-align-left"></i> (Line height)</label>
                                        <input type='number' class="" ng-model="fabric.selectedObject.lineHeight" step=".1" />
                                        </md-input-container>
                                    </div>
                                    <div class="row col-lg-6" title="Reverse" ng-show="fabric.selectedObject.type == 'curvedText'">
                                        <md-checkbox ng-model="fabric.selectedObject.isReversed" aria-label="Reverse" ng-click="toggleReverse(fabric.selectedObject.isReversed);">Reverse </md-checkbox>
                                    </div>
                                </div>
                                <div class='row form-group' ng-show="fabric.selectedObject.type == 'text' || fabric.selectedObject.type == 'curvedText'">
                                    <md-button class="md-raised md-cornered" ng-class="{ active: fabric.selectedObject.textAlign == 'left' }" ng-click="fabric.selectedObject.textAlign = 'left'" aria-label="Align Left"><i class='fa fa-align-left'></i></md-button>
                                    <md-button class="md-raised md-cornered" ng-class="{ active: fabric.selectedObject.textAlign == 'center' }" ng-click="fabric.selectedObject.textAlign = 'center'" aria-label="Align Center"><i class='fa fa-align-center'></i></md-button>
                                    <md-button class="md-raised md-cornered" ng-class="{ active: fabric.selectedObject.textAlign == 'right' }" ng-click="fabric.selectedObject.textAlign = 'right'" aria-label="Align Right"><i class='fa fa-align-right'></i></md-button>
                                    <md-button class="md-raised md-cornered" ng-class="{ active: fabric.isBold() }" ng-click="toggleBold()" aria-label="Bold"><i class='fa fa-bold'></i></md-button>
                                    <md-button class="md-raised md-cornered" ng-class="{ active: fabric.isItalic() }" ng-click="toggleItalic()" aria-label="Italic"><i class='fa fa-italic'></i></md-button>
                                    <md-button class="md-raised md-cornered" ng-class="{ active: fabric.isUnderline() }" ng-click="toggleUnderline()" aria-label="Underline"><i class='fa fa-underline'></i></md-button>
                                    <md-button class="md-raised md-cornered" ng-class="{ active: fabric.isLinethrough() }" ng-click="toggleLinethrough()" aria-label="Strike through"><i class='fa fa-strikethrough'></i></md-button>
                                </div>
                                <div class='row form-group curved_text' ng-show="fabric.selectedObject.type == 'text' || fabric.selectedObject.type == 'curvedText'">
                                    <md-switch ng-model="fabric.selectedObject.isCurved" aria-label="Switch 1" ng-change="curveText();">Curved text </md-switch>
                                </div>
                                <div class="row form-group transparency" title="Radius" ng-show="fabric.selectedObject.type == 'curvedText'" style="margin-bottom: 0px;">
                                    <md-input-container flex>
                                    <label for="Radius">Radius:</label>
                                    <input class='col-sm-12' title="Radius" type='range' min="50" max="200" value="100" ng-model="fabric.selectedObject.radius" ng-change="radius(fabric.selectedObject.radius);"/>
                                    </md-input-container>
                                </div>
                                <div class="row form-group transparency" title="Spacing" ng-show="fabric.selectedObject.type == 'curvedText'" style="margin-bottom: 35px;">
                                    <md-input-container flex>
                                    <label for="Spacing">Spacing:</label>
                                    <input class='col-sm-12' title="Spacing" type='range' min="5" max="30" value="10" ng-model="fabric.selectedObject.spacing" ng-change="spacing(fabric.selectedObject.spacing);"/>
                                    </md-input-container>
                                </div>
                                <div class="row form-group input-group colorPicker2" ng-show="fabric.selectedObject.type != 'image' && fabric.selectedObject.type != 'path'">
                                    <md-input-container flex>
                                    <label for="Color">Color:</label>
                                    <input type="text" value="" class="" colorpicker ng-model="fabric.selectedObject.fill" ng-change="fillColor(fabric.selectedObject.fill);"/>
                                    </md-input-container>
                                    <span class="input-group-addon" style="border: medium none #000000; background-color: {{fabric.selectedObject.fill}}"><i></i></span>
                                </div>
                                <div class="row form-group transparency" ng-show="fabric.selectedObject.type != 'curvedText'">
                                    <md-input-container flex>
                                    <label for="Transparency">Transparency:</label>
                                    <input class='col-sm-12' title="Transparency" type='range' min="0" max="1" step=".01" ng-model="fabric.selectedObject.opacity" ng-change="opacity(fabric.selectedObject.opacity);"/>
                                    </md-input-container>
                                </div>
                                <div class="col-sm-12 input-group cloud-options" ng-show="fabric.selectedObject.type == 'image'">
                                    <label class="custom-label">Filters:</label>
                                    <br>
                                    <md-checkbox ng-model="fabric.selectedObject.isGrayscale" aria-label="Grayscale" ng-click="setImageFilter(fabric.selectedObject.isGrayscale, 0);">Grayscale</md-checkbox>
                                    <md-checkbox ng-model="fabric.selectedObject.isSepia" aria-label="Sepia" ng-click="setImageFilter(fabric.selectedObject.isSepia, 1);">Sepia</md-checkbox>
                                    <md-checkbox ng-model="fabric.selectedObject.isInvert" aria-label="Invert" ng-click="setImageFilter(fabric.selectedObject.isInvert, 2);">Invert</md-checkbox>
                                    <md-checkbox ng-model="fabric.selectedObject.isEmboss" aria-label="Emboss" ng-click="setImageFilter(fabric.selectedObject.isEmboss, 3);">Emboss</md-checkbox>
                                    <md-checkbox ng-model="fabric.selectedObject.isSharpen" aria-label="Sharpen" ng-click="setImageFilter(fabric.selectedObject.isSharpen, 4);">Sharpen</md-checkbox>
                                </div>
                            </div>
                        </div>
                        <!---->
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 canvas_section" ng-show="launch_step = 'create'">
                        <div class="row">
                            <div class="canvas_image image-builder ng-isolate-scope">
                                <div class='fabric-container'>
                                    <div class="canvas-container-outer">
                                        <canvas fabric='fabric'></canvas>
                                    </div>
                                    <div class="btn-group-vertical btn-group-one">
                                        <div class="icon-vertical m-b-sm pull-right">
                                            <ul>
                                                <li class="saveObject">
                                                    <span class="fa fa-save"></span>
                                                    <ul class="ulChildMenu">
                                                        <li class="childLi">
                                                            <a ng-click="saveObjectAsSvg()" href="#" class="ng-scope">Save as SVG</a>
                                                        </li>
                                                        <li class="childLi">
                                                            <a ng-click="saveObjectAsPng()" href="#" class="ng-scope">Save as PNG</a>
                                                        </li>
                                                        <li class="childLi">
                                                            <a ng-click="saveObjectAsJpg()" href="#" class="ng-scope">Save as JPG</a>
                                                        </li>
                                                        <li class="childLi">
                                                            <a ng-click="downloadObjectAsPdf()" href="#" class="ng-scope">Download as PDF</a>
                                                        </li>
                                                    </ul>
                                                </li>
                                                <li>
                                                    <a ng-click="printObject()" href="#" class="ng-scope"><span class="fa fa-print"></span></a>
                                                    <md-tooltip md-visible="print.showTooltip" md-direction="left">Print</md-tooltip>
                                                </li>
                                                <li>
                                                    <a ng-click="downloadObject()" href="#" class="ng-scope"><span class="fa fa-cloud-download"></span></a>
                                                    <md-tooltip md-visible="download.showTooltip" md-direction="left">Download as PNG</md-tooltip>
                                                </li>
                                                <li class="">
                                                    <a class="fa fa-search-plus ng-scope ng-isolate-scope" translate="" ng-click="zoomObject('zoomin')" href="#"><span class="ng-binding ng-scope"></span></a>
                                                    <md-tooltip md-visible="zoomin.showTooltip" md-direction="left">Select object and Zoom In</md-tooltip>
                                                </li>
                                                <li>
                                                    <a class="fa fa-search-minus ng-scope ng-isolate-scope" translate="" ng-click="zoomObject('zoomout')" href="#"><span class="ng-binding ng-scope"></span></a>
                                                    <md-tooltip md-visible="zoomout.showTooltip" md-direction="left">Select object and  Zoom Out</md-tooltip>
                                                </li>
                                            </ul>
                                            <ul>
                                                <li>
                                                    <a class="fa fa-undo ng-scope ng-isolate-scope" translate="" ng-click="undo()" href="#"><span class="ng-binding ng-scope"></span></a>
                                                    <md-tooltip md-visible="undo.showTooltip" md-direction="left">Undo</md-tooltip>
                                                </li>
                                                <li>
                                                    <a class="fa fa-repeat ng-scope ng-isolate-scope" translate="" ng-click="redo()" href="#"><span class="ng-binding ng-scope"></span></a>
                                                    <md-tooltip md-visible="redo.showTooltip" md-direction="left">Redo</md-tooltip>
                                                </li>
                                            </ul>
                                        </div>
                                        <div class="social-share">
                                            <a href="javascript:void(0);" id="f_share_button" class="fa fa-facebook" ng-click="shareOnFacebook($event);"></a> <a href="javascript:void(0)" class="fa fa-twitter" ng-click="shareOnTwitter($event);"></a>
                                        </div>
                                    </div>
                                    <div class="btn-group-vertical btn-group-two">
                                        <div class="icon-vertical m-b-sm pull-right" style="float: left ! important;">
                                            <ul>
                                                <li>
                                                    <a ng-click="layers()" href="#Layers" data-toggle="tab" class="fa fa-object-ungroup"></a>
                                                    <md-tooltip md-visible="layer.showTooltip" md-direction="right">Layers</md-tooltip>
                                                </li>
                                                <li>
                                                    <a ng-click="copyItem()" href="#" class="fa fa-copy"></a>
                                                    <md-tooltip md-visible="copy.showTooltip" md-direction="right">Copy</md-tooltip>
                                                </li>
                                                <li>
                                                    <a ng-click="pasteItem()" href="#" class="fa fa-paste"></a>
                                                    <md-tooltip md-visible="paste.showTooltip" md-direction="right">Paste</md-tooltip>
                                                </li>
                                                <li>
                                                    <a ng-click="forwardSwap()" href="#" class="fa fa-mail-forward"></a>
                                                    <md-tooltip md-visible="forward.showTooltip" md-direction="right">Forward Swap</md-tooltip>
                                                </li>
                                                <li>
                                                    <a ng-click="backwordSwap()"  href="#" class="fa fa-mail-reply"></a>
                                                    <md-tooltip md-visible="backward.showTooltip" md-direction="right">Backward Swap</md-tooltip>
                                                </li>
                                                <li>
                                                    <a ng-click="horizontalAlign()" href="#" class="fa fa-arrows-h"></a>
                                                    <md-tooltip md-visible="horizontal.showTooltip" md-direction="right">Horizontal Align</md-tooltip>
                                                </li>
                                                <li>
                                                    <a ng-click="verticalAlign()" href="#" class="fa fa-arrows-v"></a>
                                                    <md-tooltip md-visible="vertical.showTooltip" md-direction="right">Vertical Align</md-tooltip>
                                                </li>
                                                <li>
                                                    <a ng-click="{ active: flipObject() }" href="#" class="fa fa-exchange fa-2"></a>
                                                    <md-tooltip md-visible="flip.showTooltip" md-direction="right">Flip</md-tooltip>
                                                </li>
                                            </ul>
                                            <ul class="but_dist">
                                                <li>
                                                    <a ng-click="lockObject()" ng-class="isLocked() ? 'fa fa-lock' : 'fa fa-unlock'" href="#"></a>
                                                    <md-tooltip md-visible="lock.showTooltip" md-direction="right">Lock Layer</md-tooltip>
                                                </li>
                                                <li>
                                                    <a ng-click="removeSelectedObject()" href="#" class="fa fa-eraser"></a>
                                                    <md-tooltip md-visible="remove.showTooltip" md-direction="right">Remove Layer</md-tooltip>
                                                </li>
                                                <li>
                                                    <a ng-click="clearAll()" href="#" class="fa fa-trash"></a>
                                                    <md-tooltip md-visible="clear.showTooltip" md-direction="right">Empty Canvas</md-tooltip>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="canvas_sub_image">
                                <ul>
                                    <li ng-repeat="prodImg in productImages">
                                        <img ng-click='loadProduct(defaultProductTitle, prodImg, defaultProductId, defaultPrice, defaultCurrency, $index)' data-ng-src="{{prodImg}}" alt="" width="120px;">
                                    </li>
                                </ul>
                            </div>
                            <div class="canvas_details clearfix">
                                <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                                    <span class="product_name">{{defaultProductTitle}}</span>
                                </div>
                                <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12 clearfix">
                                    <span class="pull-left">Qty:</span>
                                    <div class="m-prod_detail_attr">
                                        <div class="pull-left m-prod_counter">
                                            <span ng-click="increments()"><i class="fa fa-plus"></i></span>
                                            <span ng-click="decrement()"><i class="fa fa-minus"></i></span>
                                            <input type="text" value="{{counter}}" id="m-prod_count" name="quantity" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-3 col-sm-3 col-xs-12 clearfix pricing">
                                    <div class="col-lg-12 col-me-12 com-sm-12 col-xs-12">
                                        <span class="price_title">Price</span>
                                        <span class="price_amnt">{{defaultPrice}} {{defaultCurrency}}</span>
                                    </div>
                                </div>
                                <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
                                    <a class="cart_icon" href="javascript:void(0)" ng-click="addToCart()">
                                        <i class="fa fa-shopping-cart"></i>
                                        Add to cart
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-2 tab-content-1 step1_2">
                        <!-- step create-->
                        <div class="launch-step-create" >
                            <div class="form-group lil-lil-pad">
                                <label>Purpose</label>
                                <select class="tab-select input-width" ng-model="campaign_data.purpose">
                                    <option value="Weight Management">Weight Management</option>
                                    <option value="Wellness">Wellness</option>
                                    <option value="Strength">Strength</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Formula</label>
                                <select class="tab-select input-width" ng-model="campaign_data.formula">
                                    <option ng-show="campaign_data.purpose =='Weight Management'" value="Green Coffee Bean Extract">Green Coffee Bean Extract</option>
                                    <option ng-show="campaign_data.purpose =='Weight Management'" value="Raspberry Ketone Burner">Raspberry Ketone Burner</option>
                                    <option ng-show="campaign_data.purpose =='Weight Management'" value="Garcinia Cambogia">Garcinia Cambogia (60% Standardized)</option>
                                    <option ng-show="campaign_data.purpose =='Weight Management'" value="Safflower Oil">Safflower Oil (CLA)</option>
                                    <option ng-show="campaign_data.purpose =='Weight Management'" value="African Mango Cleanse">African Mango Cleanse</option>
                                    <option ng-show="campaign_data.purpose =='Weight Management'" value="Rasberry Ketone Cleanse">Rasberry Ketone Cleanse</option>
                                    <option ng-show="campaign_data.purpose =='Weight Management'" value="GABA Sleep Aid">GABA Sleep Aid</option>

                                    <option ng-show="campaign_data.purpose =='Wellness'" value="Probiotic 1150">Probiotic 1150</option>
                                    <option ng-show="campaign_data.purpose =='Wellness'" value="Omega-3">Omega-3 from Chile </option>
                                    <option ng-show="campaign_data.purpose =='Wellness'" value="Krill Oil">Krill Oil</option>
                                    <option ng-show="campaign_data.purpose =='Wellness'" value="One Tab Daily">One Tab Daily</option>
                                    <option ng-show="campaign_data.purpose =='Wellness'" value="Multivitamin 2000">Multivitamin 2000</option>
                                    <option ng-show="campaign_data.purpose =='Wellness'" value="Multivatmin 2400">Multivatmin 2400</option>
                                    <option ng-show="campaign_data.purpose =='Wellness'" value="Whole Foods Mutli">Whole Foods Mutli</option>
                                    <option ng-show="campaign_data.purpose =='Wellness'" value="Life's Vitality Mutli">Life's Vitality Mutli</option>
                                    <option ng-show="campaign_data.purpose =='Wellness'" value="Turmeric Complex with Bioperine">Turmeric Complex with Bioperine</option>
                                    <option ng-show="campaign_data.purpose =='Wellness'" value="Sleep Formula 786">Vitamin C</option>
                                    <option ng-show="campaign_data.purpose =='Wellness'" value="Sleep Formula 786">Calcium</option>
                                    <option ng-show="campaign_data.purpose =='Wellness'" value="Sleep Formula 786">B Complex</option>

                                    <option ng-show="campaign_data.purpose =='Strength'" value="L-Glutamine">L-Glutamine</option>
                                    <option ng-show="campaign_data.purpose =='Strength'" value="L-Arginine">L-Arginine</option>
                                    <option ng-show="campaign_data.purpose =='Strength'" value="L-Carnitine">L-Carnitine (Tartrate)</option>
                                    <option ng-show="campaign_data.purpose =='Strength'" value="Ginger Root">Ginger Root </option>
                                    <option ng-show="campaign_data.purpose =='Strength'" value="Ginsing Complex">Ginsing Complex</option>
                                    <option ng-show="campaign_data.purpose =='Strength'" value="Nitro Pump">Nitro Pump</option>
                                    <option ng-show="campaign_data.purpose =='Strength'" value="Creatine Monohydrate (700)">Creatine Monohydrate (700)</option>
                                    <option ng-show="campaign_data.purpose =='Strength'" value="Creatine Monohydrate (2500)">Creatine Monohydrate (2500)</option>

                                </select>
                            </div>
                            <div ng-show="campaign_data.formula">
                                <div class="ingredients">
                                    <div class="CLA_1" ng-if="campaign_data.formula == 'Green Coffee Bean Extract'">
                                        <h4>Green Coffee Bean Extract</h4>
                                        <h5>Weight Loss &#183 Energy</h5>
                                        <h5>800 mg</h5>
                                    </div>

                                    <div class="CLA_1" ng-if="campaign_data.formula == 'Raspberry Ketone Burner'">
                                        <h4>Raspberry Ketones</h4>
                                        <h5>Weight Loss &#183 Energy</h5>
                                        <h5>600 mg</h5>
                                    </div>
                                    <div class="CLA_1" ng-if="campaign_data.formula == 'Raspberry Ketone Burner'">
                                        <h4>African Mango</h4>
                                        <h5>Weight Loss &#183 Energy</h5>
                                        <h5>--</h5>
                                    </div>
                                    <div class="CLA_1" ng-if="campaign_data.formula == 'Raspberry Ketone Burner'">
                                        <h4>Acai Fruit</h4>
                                        <h5>Weight Loss &#183 Energy</h5>
                                        <h5>--</h5>
                                    </div>
                                    <div class="CLA_1" ng-if="campaign_data.formula == 'Raspberry Ketone Burner'">
                                        <h4>Green Tea</h4>
                                        <h5>Weight Loss &#183 Energy</h5>
                                        <h5>--</h5>
                                    </div>
                                    <div class="CLA_1" ng-if="campaign_data.formula == 'Raspberry Ketone Burner'">
                                        <h4>Resveratrol</h4>
                                        <h5>Weight Loss &#183 Energy</h5>
                                        <h5>--</h5>
                                    </div>
                                    <div class="CLA_1" ng-if="campaign_data.formula == 'Raspberry Ketone Burner'">
                                        <h4>Kelp</h4>
                                        <h5>Weight Loss &#183 Energy</h5>
                                        <h5>--</h5>
                                    </div>

                                    <div class="CLA_1" ng-if="campaign_data.formula == 'Garcinia Cambogia'">
                                        <h4>Potassium</h4>
                                        <h5>Weight Loss &#183 Energy</h5>
                                        <h5>50 mg</h5>
                                    </div>
                                    <div class="CLA_1" ng-if="campaign_data.formula == 'Garcinia Cambogia'">
                                        <h4>Calcium</h4>
                                        <h5>Weight Loss &#183 Energy</h5>
                                        <h5>50 mg</h5>
                                    </div>
                                    <div class="CLA_1" ng-if="campaign_data.formula == 'Garcinia Cambogia'">
                                        <h4>Calcium</h4>
                                        <h5>Weight Loss &#183 Energy</h5>
                                        <h5>200 mcg</h5>
                                    </div>
                                    <div class="CLA_1" ng-if="campaign_data.formula == 'Garcinia Cambogia'">
                                        <h4>Garcinia Cambogia</h4>
                                        <h5>Weight Loss &#183 Energy</h5>
                                        <h5>1000 mg</h5>
                                    </div>

                                    <div class="CLA_1" ng-if="campaign_data.formula == 'Safflower Oil'">
                                        <h4>CLA</h4>
                                        <h5>Weight Loss &#183 Energy</h5>
                                        <h5>1000 mg</h5>
                                    </div>

                                    <div class="CLA_1" ng-if="campaign_data.formula == 'African Mango Cleanse'">
                                        <h4>African Mango</h4>
                                        <h5>Weight Loss &#183 Energy</h5>
                                        <h5>800 mg</h5>
                                    </div>
                                    <div class="CLA_1" ng-if="campaign_data.formula == 'African Mango Cleanse'">
                                        <h4>Flax Seed</h4>
                                        <h5>Weight Loss &#183 Energy</h5>
                                        <h5>--</h5>
                                    </div>
                                    <div class="CLA_1" ng-if="campaign_data.formula == 'African Mango Cleanse'">
                                        <h4>Oat Bran</h4>
                                        <h5>Weight Loss &#183 Energy</h5>
                                        <h5>--</h5>
                                    </div>
                                    <div class="CLA_1" ng-if="campaign_data.formula == 'African Mango Cleanse'">
                                        <h4>Cayenne Pepper</h4>
                                        <h5>Weight Loss &#183 Energy</h5>
                                        <h5>--</h5>
                                    </div>
                                    <div class="CLA_1" ng-if="campaign_data.formula == 'African Mango Cleanse'">
                                        <h4>Licorice</h4>
                                        <h5>Weight Loss &#183 Energy</h5>
                                        <h5>--</h5>
                                    </div>
                                    <div class="CLA_1" ng-if="campaign_data.formula == 'African Mango Cleanse'">
                                        <h4>Ginger</h4>
                                        <h5>Weight Loss &#183 Energy</h5>
                                        <h5>--</h5>
                                    </div>
                                    <div class="CLA_1" ng-if="campaign_data.formula == 'African Mango Cleanse'">
                                        <h4>Prune Juice</h4>
                                        <h5>Weight Loss &#183 Energy</h5>
                                        <h5>--</h5>
                                    </div>
                                    <div class="CLA_1" ng-if="campaign_data.formula == 'African Mango Cleanse'">
                                        <h4>Aloe Vera</h4>
                                        <h5>Weight Loss &#183 Energy</h5>
                                        <h5>--</h5>
                                    </div>
                                    <div class="CLA_1" ng-if="campaign_data.formula == 'African Mango Cleanse'">
                                        <h4>Golden Seal</h4>
                                        <h5>Weight Loss &#183 Energy</h5>
                                        <h5>--</h5>
                                    </div>
                                </div>
                                <div class="ing-ex text-center">
                                    <h5>All quantities per serving.</h5>
                                    <h3>Base Cost @ 30 Bottles:</h3>
                                    <h2>$5.75</h2>
                                </div>
                            </div>
                        </div>
                        <div class="lil-pad">
                            <center>
                                <div class='btn btn-wj btn-sm'>Continue</div>
                            </center>
                        </div>
                </div>
            </div>
        </div>
    </div>
        <script src="assets/angular.js"></script>
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
    <script>
    $scope.launch_step = 'create';
    </script>
</html>
