@extends('layouts.app')  
@section('content')


		<!-- Main Content -->
		<div class="page-wrapper">
			<div class="container-fluid">
				
				<!-- Title -->
				<div class="row heading-bg">
					<div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
					  <h5 class="txt-dark">Dealers</h5>
					</div>
					<!-- Breadcrumb -->
					<div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
						<a href="{{URL::to('dealers/create')}}"><button class="pull-right btn btn-success fancy-button btn-0">Add Dealer</button></a>
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
										<div class="table-responsive" style="overflow: hidden;">
											<table id="dealers" class="table table-hover display  pb-30" >
												<thead>
													<tr>
														<th></th>
														<th>Sr.</th>
														<th>Region</th>
														<th>Dealer code</th>
														<th>Dealership Name</th>
														<th>created at</th>
														<th>Action</th>
														{{-- <th class="text-nowrap">Action</th> --}}
													</tr>
												</thead>
												<tbody>
												  <tr>
													<td></td>
													<td>1</td>
													<td>at002526@gmail.com</td>
													<td><span class="label label-danger">admin</span> </td>
													<td>Brincker123</td>
													<td>Brincker123</td>
													<td class="text-nowrap"><a href="{{URL::to('/users/edit')}}" class="mr-25" data-toggle="tooltip" data-original-title="Edit"> <i class="fa fa-pencil text-inverse m-r-10"></i> </a> <a href="#" data-toggle="tooltip" data-original-title="Close"> <i class="fa fa-close text-danger"></i> </a> </td>
												  </tr>
												</tbody>											
												<tfoot>
													<tr>
														<th></th>
														<th>Sr.</th>
														<th>Region</th>
														<th>Dealer code</th>
														<th>Dealership Name</th>
														<th>created at</th>
														<th>Action</th>
														{{-- <th class="text-nowrap">Action</th> --}}
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

