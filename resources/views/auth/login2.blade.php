<!DOCTYPE html>
<html lang="">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Mango: Hospital Management System</title>

    <!-- Bootstrap Core CSS background:#4B0082-->
    <link href="/css/bower_components/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- MetisMenu CSS -->
    <link href="/css/bower_components/metisMenu/dist/metisMenu.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="/css/dist/css/sb-admin-2.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="/css/bower_components/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body>
<div class="container-fluid">
    <div class="row" style="background:#293955">
        <div class="col-md-12 col-sm-12">
            <div class="softwareName">
                {{--<h1><img src="Images/logo.png" width="191" height="60"></h1>--}}
                <p>Hygei Hospital</p>
            </div>
        </div>
    </div>
</div>

<!-- <div class="container">
	<div class="row" style="margin-top:20px;">
    	<div class="col-md-6 col-md-offset-3">
        <div class="alert alert-dismissible alert-info glyphicon glyphicon-bullhorn">
  <button type="button" class="close" data-dismiss="alert">×</button>
  <strong>There is An Emergency</strong></div>
        </div>
    </div>

</div> -->


<div class="container">
    <div class="row">


        <div class="col-md-4 col-md-offset-4">
            <div class="login-panel panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">Please Sign In </h3>
                </div>
                <div class="panel-body">

                    @include('partials.errors')

                    <form role="form" action="/login" method="post">
                        {{csrf_field()}}
                        <fieldset>
                            <div class="form-group">
                                <input class="form-control" placeholder="E-mail" name="email" type="email" autofocus>
                            </div>
                            <div class="form-group">
                                <input class="form-control" placeholder="Password" name="password" type="password"
                                       value="">
                            </div>
                            <div class="checkbox">
                                <label>
                                    <input name="remember" type="checkbox" value="Remember Me">Remember Me
                                </label>
                            </div>
                            <!-- Change this to a button or input when using this as a form -->
                            <button type="submit" class="btn btn-lg btn-success btn-block">Login</button>
                        </fieldset>


                    </form>
                </div>
            </div>
        </div>


    </div>
</div>

<!-- jQuery -->
<script src="/css/bower_components/jquery/dist/jquery.min.js"></script>

<!-- Bootstrap Core JavaScript -->
<script src="/css/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>

<!-- Metis Menu Plugin JavaScript -->
<script src="/css/bower_components/metisMenu/dist/metisMenu.min.js"></script>

<!-- Custom Theme JavaScript -->
<script src="/css/dist/js/sb-admin-2.js"></script>

</body>

</html>
