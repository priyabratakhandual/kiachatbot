
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>KIA Activity Portal</title>
        <meta name="description" content="KIA Activity Portal" />
        <meta name="keywords" content="KIA Activity Portal" />
        <meta name="author" content="KIA Activity Portal"/>
        
        <!-- vector map CSS -->
        <link href="{{ asset('vendors/bower_components/jasny-bootstrap/dist/css/jasny-bootstrap.min.css') }}" rel="stylesheet" type="text/css"/>
        
        <link href="{{ asset('full-width-dark/dist/css/style.css') }}" rel="stylesheet" type="text/css">
    </head>
    <body>
        <!--Preloader-->
{{--         <div class="preloader-it">
            <div class="la-anim-1"></div>
        </div> --}}
        <!--/Preloader-->
        
        <div class="wrapper pa-0">
{{--             <header class="sp-header">
                <div class="sp-logo-wrap pull-left">
                    <a href="index.html">
                        <img class="brand-img mr-10" src="../img/logo.png" alt="brand"/>
                        <span class="brand-text">Grandin</span>
                    </a>
                </div>
                <div class="form-group mb-0 pull-right">
                    <span class="inline-block pr-10">Don't have an account?</span>
                    <a class="inline-block btn btn-primary  btn-rounded" href="signup.html">Sign Up</a>
                </div>
                <div class="clearfix"></div>
            </header> --}}