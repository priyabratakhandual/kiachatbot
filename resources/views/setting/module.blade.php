@extends('layouts.app')  
@section('content')


			<!-- Main Content -->
			<div class="page-wrapper">
				<div class="container-fluid">
					
					<!-- Title -->
					<div class="row heading-bg">
						<div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
						  <h5 class="txt-dark">Modules</h5>
						</div>
						<!-- Breadcrumb -->
						<div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
						 	<button data-toggle="modal" data-target="#addmodule" class="pull-right btn btn-success btn-outline btn-0">Create module</button>
						</div>
						<!-- /Breadcrumb -->
					</div>
					<!-- /Title -->

					<div id="addmodule" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
						<div class="modal-dialog">
							<div class="modal-content">
								<div class="modal-header">
									<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
									<h5 class="modal-title">Create Module</h5>
								</div>
								<form id="create_module_form">
								@csrf
								<div class="modal-body">
										<div class="form-group">
											<label for="label" class="control-label mb-10">Name:</label>
											<input type="text" class="form-control" id="label" name="label">
										</div>
										<div class="form-group">
											<label for="description" class="control-label mb-10">Description:</label>
											<textarea class="form-control" id="description" name="description"></textarea>
										</div>
								</div>
								<div class="modal-footer">
									<button type="submit" id="create_module_submit" class="btn btn-danger">Save changes</button>
								</div>
								</form>
							</div>
						</div>
					</div>
				
					<!-- Row -->
					<div class="row">
                       @foreach($modules as $module)
						<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
							<div class="panel panel-default card-view panel-refresh">
								<div class="refresh-container">
									<div class="la-anim-1"></div>
								</div>
								<div class="panel-heading">
									<div class="pull-left">
										<h6 class="panel-title txt-dark">{{$module->name}}</h6>
									</div>
									<div class="pull-right">
										<a class="pull-left inline-block mr-15" data-toggle="collapse" href="#collapse_1" aria-expanded="true">
											<i class="zmdi zmdi-chevron-down"></i>
											<i class="zmdi zmdi-chevron-up"></i>
										</a>
										<div class="pull-left inline-block dropdown mr-15">
											<a class="dropdown-toggle" data-toggle="dropdown" href="#" aria-expanded="false" role="button"><i class="zmdi zmdi-more-vert"></i></a>
											<ul class="dropdown-menu bullet dropdown-menu-right"  role="menu">
												<li role="presentation"><a href="javascript:void(0)" role="menuitem"><i class="icon wb-reply" aria-hidden="true"></i>option 1</a></li>
												<li role="presentation"><a href="javascript:void(0)" role="menuitem"><i class="icon wb-share" aria-hidden="true"></i>option 2</a></li>
												<li role="presentation"><a href="javascript:void(0)" role="menuitem"><i class="icon wb-trash" aria-hidden="true"></i>option 3</a></li>
											</ul>
										</div>
										<a href="#" class="pull-left inline-block refresh mr-15">
											<i class="zmdi zmdi-replay"></i>
										</a>
										<a href="#" class="pull-left inline-block full-screen mr-15">
											<i class="zmdi zmdi-fullscreen"></i>
										</a>
									</div>
									<div class="clearfix"></div>
								</div>
								<div  id="collapse_1" class="panel-wrapper collapse in">
									<div  class="panel-body">
										<p>{{$module->description}}</p>
									</div>
								</div>
							</div>
						</div>
                       @endforeach
 
					</div>
					<!-- /Row -->
				</div>
			</div>
			<!-- /Main Content -->

@endsection