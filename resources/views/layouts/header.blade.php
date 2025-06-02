<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
        <title>KIA Activity Portal</title>
        <meta name="description" content="Kia" />
        <meta name="keywords" content="Kia" />
        <meta name="author" content="Kia"/>
        <meta name="csrf-token" content="{{ csrf_token() }}">

	
	<!-- Data table CSS -->
	<link href="{{ asset('vendors/bower_components/datatables/media/css/jquery.dataTables.min.css') }}" rel="stylesheet" type="text/css"/>
	
	<!-- Toast CSS -->
	<link href="{{ asset('vendors/bower_components/jquery-toast-plugin/dist/jquery.toast.min.css') }}" rel="stylesheet" type="text/css">
	
	<link href="{{ asset('vendors/bower_components/bootstrap-treeview/dist/bootstrap-treeview.min.css') }}" rel="stylesheet" type="text/css">
	
	<!-- Custom CSS -->
	<link href="{{ asset('full-width-dark/dist/css/style.css') }}" rel="stylesheet" type="text/css">
	<link href="{{ asset('full-width-dark/dist/css/style-light.css') }}" rel="stylesheet" type="text/css">
	<link href="{{ asset('custom/css/style.css') }}" rel="stylesheet" type="text/css">
	<link href="{{ asset('vendors/bower_components/multiselect/css/multi-select.css') }}" rel="stylesheet" type="text/css"/>
	<link href="{{ asset('vendors/bower_components/fullcalendar/dist/fullcalendar.css') }}" rel="stylesheet" type="text/css"/>

	<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/select/1.3.1/css/select.dataTables.min.css">
	<link href="{{ asset('vendors/bower_components/select2/dist/css/select2.min.css') }}" rel="stylesheet" type="text/css"/>
    {{-- <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" /> --}}
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-fileinput/4.4.7/css/fileinput.css">
    <link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <style type="text/css">
    	.nav .dropdown-menu > li > a {
		    color: #ffffff;
		}
		select{
			height: auto !important;
		}
		.select2-selection--multiple {
		    border: solid black 1px;
		    height: 100% !important;
		    outline: 0;
		}.datepicker-dropdown {
		    background: #ffffff;
		}
		.wrapper.theme-6-active .navbar.navbar-inverse.navbar-fixed-top {
    background: #ffffff;
    border-bottom: 1px solid #27242a;
}.wrapper.theme-6-active .navbar.navbar-inverse.navbar-fixed-top .mobile-only-brand {
    background: #ffffff;
}
    </style>
{{--     <style type="text/css">
@media (max-width: 1400px){
.slide-nav-toggle .page-wrapper {
   margin-left: 225px;
   left: 0px;
}
.slide-nav-toggle .fixed-sidebar-left {
   width: 225px;
}
.page-wrapper {
   margin-left: 44px;
}
.fixed-sidebar-left {
   width: 44px;
}
table.dataTable{
	padding: 0px 20px;
}
}
</style> --}}

</head>

<body>
	<!-- Preloader -->
{{-- 	<div class="preloader-it">
		<div class="la-anim-1"></div>
	</div> --}}
	<!-- /Preloader -->
    <div class="wrapper theme-6-active pimary-color-pink">
		<!-- Top Menu Items -->
		<nav class="navbar navbar-inverse navbar-fixed-top">
			<div class="mobile-only-brand pull-left">
				<div class="nav-header pull-left">
					<div class="logo-wrap">
						<a href="{{URL::to('/login')}}">
							<img class="brand-img" style="width: 90px;" src="https://kia.tutorial.inhelpdesk.com/Kia-logo.png" alt="brand"/>
							{{-- <span class="brand-text">KIA</span> --}}
						</a>
					</div>
				</div>	
				<a id="toggle_nav_btn" class="toggle-left-nav-btn inline-block ml-20 pull-left" href="javascript:void(0);"><i class="zmdi zmdi-menu"></i></a>
				<a id="toggle_mobile_search" data-toggle="collapse" data-target="#search_form" class="mobile-only-view" href="javascript:void(0);"><i class="zmdi zmdi-search"></i></a>
				<a id="toggle_mobile_nav" class="mobile-only-view" href="javascript:void(0);"><i class="zmdi zmdi-more"></i></a>
			</div>
			<div id="mobile_only_nav" class="mobile-only-nav pull-right">
				<ul class="nav navbar-right top-nav pull-right">					
					<li class="dropdown auth-drp">
						<a href="#" class="dropdown-toggle pr-0" data-toggle="dropdown"><img src="{{asset('/user.png')}}" alt="user_auth" class="user-auth-img img-circle"/><span class="user-online-status"></span></a>
						<ul class="dropdown-menu user-auth-dropdown" data-dropdown-in="flipInX" data-dropdown-out="flipOutX">
							<li>
								<a href="{{URL::to('/profile')}}"><i class="zmdi zmdi-account"></i><span>Profile</span></a>
							</li>
							<li>
								<a href="{{URL::to('/change-password')}}"><i class="zmdi zmdi-settings"></i><span>Change Password</span></a>
							</li>
							<li class="divider"></li>
							<li>
							 <a class="zmdi zmdi-power" href="#" onclick="event.preventDefault();document.getElementById('logout-form').submit();"> Log Out </a>
							 <form id="logout-form" action="{{ URL::to('/logout') }}" method="POST" style="display: none;">
							          {{ csrf_field() }}
							  </form>
							</li>
						</ul>
					</li>
				</ul>
			</div>	
		</nav>
		<!-- /Top Menu Items -->