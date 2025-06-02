@extends('layouts.app')  
@section('content')


		<!-- Main Content -->
		<div class="page-wrapper">
			<div class="container-fluid">
				
				<!-- Title -->
				<div class="row heading-bg">
					<div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
					  <h5 class="txt-dark">Go Ahead</h5>
					</div>
					<!-- Breadcrumb -->
					<div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
						<a href="{{URL::to('goahead/create')}}"><button class="pull-right btn btn-success btn-outline fancy-button btn-0">CREATE GO AHEAD</button></a>
					  {{-- <ol class="breadcrumb">
						<li><a href="index.html">Dashboard</a></li>
						<li><a href="#"><span>table</span></a></li>
						<li class="active"><span>basic table</span></li>
					  </ol> --}}
					</div>
					<!-- /Breadcrumb -->
				</div>
				<!-- /Title -->

								<!-- Row -->
				<div class="row">
					<div class="col-sm-12">
						<div class="panel panel-default card-view">
							<div class="panel-wrapper collapse in">
								<div class="panel-body">
									<div class="table-wrap">
										<div class="table-responsive">
											<table id="goahead" class="table table-hover display  pb-30" >
												<thead>
													<tr>
														<th></th>
														<th>Sr.</th>
														<th>Dealer Name</th>
														<th>Dealer Code</th>
														<th>Backend Status</th>
														<th>Roll Out Status</th>
														<th>Overall Status</th>
														<th>Field Engg.</th>
														<th>Go Ahead date</th>
														<th>Created at</th>
														<th class="text-nowrap">Action</th>
													</tr>
												</thead>											
												<tfoot>
													<tr>
														<th></th>
														<th>Sr.</th>
														<th>Dealer Name</th>
														<th>Dealer Code</th>
														<th>Backend Status</th>
														<th>Roll Out Status</th>
														<th>Overall Status</th>
														<th>Field Engg.</th>
														<th>Go Ahead date</th>
														<th>Created at</th>
														<th class="text-nowrap">Action</th>
													</tr>
												</tfoot>
											</table>
										</div>
									</div>
								</div>
							</div>
						</div>	
					</div>
				</div>
			</div>
		</div>
		<!-- /Main Content -->


@endsection


												  {{-- <tr>
													<td>1</td>
													<td>Jens</td>
													<td>at002526@gmail.com</td>
													<td><span class="label label-danger">admin</span> </td>
													<td>Brincker123</td>
													<td class="text-nowrap"><a href="{{URL::to('/users/edit')}}" class="mr-25" data-toggle="tooltip" data-original-title="Edit"> <i class="fa fa-pencil text-inverse m-r-10"></i> </a> <a href="#" data-toggle="tooltip" data-original-title="Close"> <i class="fa fa-close text-danger"></i> </a> </td>
												  </tr> --}}