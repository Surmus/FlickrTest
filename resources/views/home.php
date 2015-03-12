<!DOCTYPE html>
    <!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
    <!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
    <!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
    <!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title></title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="css/normalize.css">
        <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap.min.css">
        <link rel="stylesheet" href="css/main.css">
        <script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
        <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.1/js/bootstrap.min.js"></script>
        <script src="//code.angularjs.org/1.2.9/angular.js"></script>
    </head>
    <body ng-app="flicktTest" resizable>
        <!--[if lt IE 7]>
        <p class="browsehappy">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
        <![endif]-->
        <div ng-controller="MainCtrl">
            <!-- Modal -->
            <div class="modal fade" id="shareModal" tabindex="-1" role="dialog" aria-labelledby="shareLink" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title" id="myModalLabel">Share ...</h4>
                        </div>
                        <div class="modal-body">
                            <a href="{{ shareLink }}" target="_blank">{{ shareLink }}</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="navbar navbar-default navbar-top nav">
                <div class="container" id="nav-container">
                    <div class="row">
                        <div class="navbar-header col-lg-6 col-xs-8">
                            <form ng-submit="search()">
                                <input ng-model="searchTags" class="form-control" id="img-search" placeholder="Search images" type="text">
                            </form>
                        </div>
                        <div class="navbar-header navbar-right col-lg-1 col-xs-4" id="navbar-main">
                               <a href="#" data-toggle="modal" data-target="#shareModal" class="btn btn btn-primary">Share...</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="nav-background"></div>
            <div class="clearfix"></div>
            <div class="container">
                <div class="alert alert-warning center-block" ng-hide="!error" role="alert">{{ error }}</div>
                <div class="alert alert-dismissible alert-info center-block" ng-hide="!images || loading">
                    <p ng-show="cached">Images retrieved from cache</p>
                    <p ng-show="!cached">Images retrieved from Flickr</p>
                </div>
                <div class="row loader" ng-hide="!loading">
                    <div class="progress progress-striped active col-md-4 col-md-offset-4 col-xs-12">
                        <div class="progress-bar" style="width: 100%"></div>
                    </div>
                </div>
                <div class="row" ng-hide="loading">
                    <div ng-repeat="image in images" class="img-c col-sm-4 col-md-2 col-xs-12">
                        <div class="image" image-container>
                            <div class="background-container">
                                <div class="img-background"></div>
                            </div>
                            <img src="{{ image.imageUrl }}" alt="{{ image.title }}" class="img-responsive center-block" image/>
                        </div>
                        <div class="title-container">
                            <div class="img-title">{{ image.title }}</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <script src="js/main.js"></script>
    </body>
</html>
