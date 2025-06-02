@extends('layouts.app')  
@section('content')


			<!-- Main Content -->
			<div class="page-wrapper">
				<div class="container-fluid">
					
					<!-- Title -->
					<div class="row heading-bg">
						<div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
							<h5 class="txt-dark">Go Ahead Details</h5>
						</div>
{{-- 					
						<!-- Breadcrumb -->
						<div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
							<ol class="breadcrumb">
								<li><a href="index.html">Dashboard</a></li>
								<li><a href="#"><span>form</span></a></li>
								<li class="active"><span>form-layout</span></li>
							</ol>
						</div>
						<!-- /Breadcrumb --> --}}
					
					</div>
					<!-- /Title -->
				
					
					<!-- Row -->
					<div class="row">
						<div class="col-md-12">
							<div class="panel panel-default card-view">
								<div class="panel-heading">
									<div class="pull-left">
										<h6 class="panel-title txt-dark">Read only</h6>
									</div>
									<div class="clearfix"></div>
								</div>
								<div class="panel-wrapper collapse in">
									<div class="panel-body">
										<div class="row">
											<div class="col-md-12">
												<div class="form-wrap">
													<form class="form-horizontal" role="form">
														<div class="form-body">
															<h6 class="txt-dark capitalize-font"><i class="zmdi zmdi-account mr-10"></i>General Info</h6>
															<hr class="light-grey-hr"/>
															<div class="row">
																<div class="col-md-6">
																	<div class="form-group">
																		<label class="control-label col-md-3">Dealer Name:</label>
																		<div class="col-md-9">
																			<p class="form-control-static">{{$details->dealer_name}}</p>
																		</div>
																	</div>
																</div>
																<!--/span-->
																<div class="col-md-6">
																	<div class="form-group">
																		<label class="control-label col-md-3">Dealer Code:</label>
																		<div class="col-md-9">
																			<p class="form-control-static">{{$details->dealer_code}}</p>
																		</div>
																	</div>
																</div>
																<!--/span-->
															</div>

															<div class="row">
																<div class="col-md-6">
																	<div class="form-group">
																		<label class="control-label col-md-3">Go Ahead Date :</label>
																		<div class="col-md-9">
																			<p class="form-control-static">{{$details->goahead->go_ahead_date}}</p>
																		</div>
																	</div>
																</div>
																<!--/span-->
																<div class="col-md-6">
																	<div class="form-group">
																		<label class="control-label col-md-3">For Code :</label>
																		<div class="col-md-9">
																			<p class="form-control-static">{{$details->goahead->for_code}}</p>
																		</div>
																	</div>
																</div>
																<!--/span-->
															</div>

															<div class="row">
																<div class="col-md-6">
																	<div class="form-group">
																		<label class="control-label col-md-3">Category :</label>
																		<div class="col-md-9">
																			<p class="form-control-static">{{$details->goahead->category}}</p>
																		</div>
																	</div>
																</div>
																<!--/span-->
																<div class="col-md-6">
																	<div class="form-group">
																		<label class="control-label col-md-3">Visit Required :</label>
																		<div class="col-md-9">
																			<p class="form-control-static">{{$details->goahead->visit_required}}</p>
																		</div>
																	</div>
																</div>
																<!--/span-->
															</div>
															<div class="row">
																<div class="col-md-6">
																	<div class="form-group">
																		<label class="control-label col-md-3">Outlet Code :</label>
																		<div class="col-md-9">
																			<p class="form-control-static">{{$details->goahead->outlet_code}}</p>
																		</div>
																	</div>
																</div>
																<div class="col-md-6">
																	<div class="form-group">
																		<label class="control-label col-md-3">FE Name:</label>
																		<div class="col-md-9">
																			<p class="form-control-static">{{$details->goahead->fe_name}}</p>
																		</div>
																	</div>
																</div>
															</div>
															<div class="row">
																<div class="col-md-6">
																	<div class="form-group">
																		<label class="control-label col-md-3">Consignee Code :</label>
																		<div class="col-md-9">
																			<p class="form-control-static">{{$details->goahead->consignee_code}}</p>
																		</div>
																	</div>
																</div>
																<div class="col-md-6">
																	<div class="form-group">
																		<label class="control-label col-md-3">Backend Status :</label>
																		<div class="col-md-9">
																			<p class="form-control-static">{{$details->backend_status}}</p>
																		</div>
																	</div>
																</div>
															</div>
															<div class="row">
																<div class="col-md-6">
																	<div class="form-group">
																		<label class="control-label col-md-3">Rollout Status :</label>
																		<div class="col-md-9">
																			<p class="form-control-static">{{$details->roll_out_status}}</p>
																		</div>
																	</div>
																</div>
															</div>
															
															<div class="seprator-block"></div>
															
															<h6 class="txt-dark capitalize-font"><i class="zmdi zmdi-account-box mr-10"></i>address</h6>
															<hr class="light-grey-hr"/>
															<!-- /Row -->
															<div class="row">
																<div class="col-md-6">
																	<div class="form-group">
																		<label class="control-label col-md-3">Zone :</label>
																		<div class="col-md-9">
																			<p class="form-control-static">{{$details->goahead->zone}}</p>
																		</div>
																	</div>
																</div>
																<div class="col-md-6">
																	<div class="form-group">
																		<label class="control-label col-md-3">State :</label>
																		<div class="col-md-9">
																			<p class="form-control-static">{{$details->goahead->state_code}}</p>
																		</div>
																	</div>
																</div>
															</div>
															<div class="row">
																<div class="col-md-6">
																	<div class="form-group">
																		<label class="control-label col-md-3">Region</label>
																		<div class="col-md-9">
																			<p class="form-control-static">{{$details->goahead->region_code}}</p>
																		</div>
																	</div>
																</div>
																<div class="col-md-6">
																	<div class="form-group">
																		<label class="control-label col-md-3">City :</label>
																		<div class="col-md-9">
																			<p class="form-control-static">{{$details->goahead->city_code}}</p>
																		</div>
																	</div>
																</div>
															</div>
															<div class="row">
																<div class="col-md-6">
																	<div class="form-group">
																		<label class="control-label col-md-3">Dealer Address :</label>
																		<div class="col-md-9">
																			<p class="form-control-static">{{$details->goahead->dealer_address}}</p>
																		</div>
																	</div>
																</div>
																<div class="col-md-6">
																	<div class="form-group">
																		<label class="control-label col-md-3">Dealer Pincode :</label>
																		<div class="col-md-9">
																			<p class="form-control-static">{{$details->goahead->dealer_pincode}}</p>
																		</div>
																	</div>
																</div>
															</div>
															<div class="row">
																<div class="col-md-6">
																	<div class="form-group">
																		<label class="control-label col-md-3">Location :</label>
																		<div class="col-md-9">
																			<p class="form-control-static">{{$details->goahead->location}}</p>
																		</div>
																	</div>
																</div>
															</div>
														</div>
														<div class="form-actions mt-10">
															<div class="row">
																<div class="col-md-6">
																	<div class="row">
																		<div class="col-md-offset-3 col-md-9">
																			<button type="submit" class="btn btn-info btn-icon left-icon  mr-10"> <i class="zmdi zmdi-edit"></i> <span>Edit</span></button>
																			<button type="button" class="btn btn-default">Cancel</button>
																		</div>
																	</div>
																</div>
																<div class="col-md-6"> </div>
															</div>
														</div>
													</form>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
					<!-- /Row -->
				
				</div>			
			</div>
			<!-- /Main Content -->


@endsection