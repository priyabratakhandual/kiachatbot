<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
	<title>KIA Activity Portal</title>
	<meta name="description" content="Kia" />
	<meta name="keywords" content="Kia" />
	<meta name="author" content="Kia" />
	<meta name="csrf-token" content="{{ csrf_token() }}">


	<!-- Data table CSS -->
	<link href="{{ asset('vendors/bower_components/datatables/media/css/jquery.dataTables.min.css') }}" rel="stylesheet" type="text/css" />

	<link rel="stylesheet" href="https://cdn.datatables.net/v/bs/jq-2.2.4/dt-1.10.15/r-2.1.1/datatables.min.css">

	<!-- datatable new  cdn  --> 

	<!-- Toast CSS -->
	<link href="{{ asset('vendors/bower_components/jquery-toast-plugin/dist/jquery.toast.min.css') }}" rel="stylesheet" type="text/css">
	
	<!-- sweet alert -->
	<link href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css" rel="stylesheet" type="text/css">

	<link href="{{ asset('vendors/bower_components/bootstrap-treeview/dist/bootstrap-treeview.min.css') }}" rel="stylesheet" type="text/css">

	<!-- Custom CSS -->
	<link href="{{ asset('full-width-dark/dist/css/style.css') }}" rel="stylesheet" type="text/css">
	<link href="{{ asset('full-width-dark/dist/css/style-light.css') }}" rel="stylesheet" type="text/css">
	<link href="{{ asset('custom/css/style.css') }}" rel="stylesheet" type="text/css">
	<link href="{{ asset('vendors/bower_components/multiselect/css/multi-select.css') }}" rel="stylesheet" type="text/css" />
	<link href="{{ asset('vendors/bower_components/fullcalendar/dist/fullcalendar.css') }}" rel="stylesheet" type="text/css" />

	<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/select/1.3.1/css/select.dataTables.min.css">
	<link href="{{ asset('vendors/bower_components/select2/dist/css/select2.min.css') }}" rel="stylesheet" type="text/css" />
	{{-- <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" /> --}}
	<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css">
	<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-fileinput/4.4.7/css/fileinput.css">
	<link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

</head>
<body>

   @yield('content-asset')

@include('layouts.footer')