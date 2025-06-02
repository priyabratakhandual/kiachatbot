@extends('layouts.app')  
@section('content')


			<!-- Main Content -->
			<div class="page-wrapper">
				<div class="container-fluid">
					
					<!-- Title -->
					<div class="row heading-bg">
						<div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
							<h5 class="txt-dark">CREATE GO AHEAD</h5>
						</div>
					
						<!-- Breadcrumb -->
						<div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
							{{-- <ol class="breadcrumb">
								<li><a href="index.html">Dashboard</a></li>
								<li><a href="#"><span>form</span></a></li>
								<li class="active"><span>form-layout</span></li>
							</ol> --}}
						</div>
						<!-- /Breadcrumb -->
					
					</div>
					<!-- /Title -->
					
					
					<!-- Row -->
					<div class="row">
						<div class="col-md-12">
							<div class="panel panel-default card-view">
								<div class="panel-wrapper collapse in">
									<div class="panel-body">
										<div class="row">
											<div class="col-md-12">
												<div class="form-wrap">
													<form id="add_go_ahead_form" class="form-horizontal">
														@csrf
														<div class="form-body">
															<h6 class="txt-dark capitalize-font"><i class="zmdi zmdi-account mr-10"></i>General Info</h6>
															<hr class="light-grey-hr"/>
															<div class="row">
																<div class="col-md-6">
																	<div class="form-group">
																		<label class="control-label col-md-3">Dealer Name</label>
																		<div class="col-md-9">
																			<input type="text" class="form-control" name="dealer_name" id="dealer_name">
																		</div>
																	</div>
																</div>
																<div class="col-md-6">
																	<div class="form-group">
																		<label class="control-label col-md-3">Dealer Code</label>
																		<div class="col-md-9">
																			<input type="text" class="form-control" name="dealer_code" id="dealer_code">
																		</div>
																	</div>
																</div>
															</div>
															<div class="row">
																<div class="col-md-6">
																	<div class="form-group">
																		<label class="control-label col-md-3">Go Ahead Date</label>
																		<div class="col-md-9">
																			<input type="date" class="form-control" name="go_ahead_date" id="go_ahead_date">
																		</div>
																	</div>
																</div>

																<div class="col-md-6">
																	<div class="form-group">
																		<label class="control-label col-md-3">For Code</label>
																		<div class="col-md-9">
																			<input type="text" class="form-control" name="for_code" id="for_code">
																		</div>
																	</div>
																</div>
															</div>
															<div class="row">
																<div class="col-md-6">
																	<div class="form-group">
																		<label class="control-label col-md-3">Category</label>
																		<div class="col-md-9">
																			<select class="form-control select2add" name="category" id="category">
																				@foreach($categories as $category)
																				 <option value="{{$category}}">{{$category}}</option>
																				@endforeach
																			</select>
																		</div>
																	</div>
																</div>
																<div class="col-md-6">
																	<div class="form-group">
																		<label class="control-label col-md-3">Visit Required</label>
																		<div class="col-md-9">
																			<select class="form-control select2" name="visit_required" id="visit_required">
																				<option value="no">NO</option>
																				<option value="yes">YES</option>
																			</select>
																		</div>
																	</div>
																</div>
															</div>
															<div class="row">
																<div class="col-md-6">
																	<div class="form-group">
																		<label class="control-label col-md-3">Outlet Code</label>
																		<div class="col-md-9">
																			<input type="text" class="form-control" name="outlet_code" id="outlet_code">
																		</div>
																	</div>
																</div>
																<div class="col-md-6">
																	<div class="form-group">
																		<label class="control-label col-md-3">FE Name</label>
																		<div class="col-md-9">
																			<select class="form-control select2" name="fe_id" id="fe_id">
																				@foreach($fengineers as $fengineer)
																			    	<option value="{{$fengineer->id}}">{{$fengineer->name}}</option>
																				@endforeach
																			</select>
																		</div>
																	</div>
																</div>
															</div>
															<div class="row">
																<div class="col-md-6">
																	<div class="form-group">
																		<label class="control-label col-md-3">Consignee Code</label>
																		<div class="col-md-9">
																			<input type="text" class="form-control" name="consignee_code" id="consignee_code">
																		</div>
																	</div>
																</div>
																<div class="col-md-6">
																	<div class="form-group">
																		<label class="control-label col-md-3">Backend Status</label>
																		<div class="col-md-9">
																			<select class="form-control select2" name="backend_status" id="backend_status">
																				<option value="Pending">Pending</option>
																				<option value="Completed">Completed</option>
																				<option value="Closed">Closed</option>
																			</select>
																		</div>
																	</div>
																</div>
															</div>
															<div class="row">
																<div class="col-md-6">
																	<div class="form-group">
																		<label class="control-label col-md-3">Rollout Status</label>
																		<div class="col-md-9">
																			<select class="form-control select2" name="roll_out_status" id="roll_out_status">
																				<option value="Pending">Pending</option>
																				<option value="On Hold">On Hold</option>
																				<option value="Online Completed">Online Completed</option>
																				<option value="Closed">Closed</option>
																				<option value="Completed">Completed</option>
																				<option value="To be Planned">To be Planned</option>
																			</select>
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
																		<label class="control-label col-md-3">Zone</label>
																		<div class="col-md-9">
																			<select class="form-control select2add" name="zone" id="zone">
																				@foreach($zones as $zone)
																				 <option value="{{$zone}}">{{$zone}}</option>
																				@endforeach
																			</select>
																		</div>
																	</div>
																</div>
																<div class="col-md-6">
																	<div class="form-group">
																		<label class="control-label col-md-3">State</label>
																		<div class="col-md-9">
																			<select class="form-control select2add" name="state_code" id="state_code">
																				@foreach($states as $state)
																				 <option value="{{$state}}">{{$state}}</option>
																				@endforeach
																			</select>
																		</div>
																	</div>
																</div>
															</div>
															<div class="row">
																<div class="col-md-6">
																	<div class="form-group">
																		<label class="control-label col-md-3">Region</label>
																		<div class="col-md-9">
																			<select class="form-control select2add" name="region_code" id="region_code">
																				@foreach($regions as $region)
																				 <option value="{{$region}}">{{$region}}</option>
																				@endforeach
																			</select>
																		</div>
																	</div>
																</div>
																<div class="col-md-6">
																	<div class="form-group">
																		<label class="control-label col-md-3">City</label>
																		<div class="col-md-9">
																			<select class="form-control select2add" name="city_code" id="city_code">
																				@foreach($cities as $city)
																				 <option value="{{$city}}">{{$city}}</option>
																				@endforeach
																			</select>
																		</div>
																	</div>
																</div>
															</div>
															<div class="row">
																<div class="col-md-6">
																	<div class="form-group">
																		<label class="control-label col-md-3">Dealer Address</label>
																		<div class="col-md-9">
																			<textarea class="form-control" id="dealer_address" name="dealer_address"></textarea>
																		</div>
																	</div>
																</div>
																<div class="col-md-6">
																	<div class="form-group">
																		<label class="control-label col-md-3">Dealer Pincode</label>
																		<div class="col-md-9">
																			<input type="text" class="form-control" name="dealer_pincode" id="dealer_pincode">
																		</div>
																	</div>
																</div>
															</div>
															<div class="row">
																<div class="col-md-6">
																	<div class="form-group">
																		<label class="control-label col-md-3">Location</label>
																		<div class="col-md-9">
																			<input type="text" class="form-control" name="location" id="location">
																		</div>
																	</div>
																</div>
															</div>
														</div>
														<div class="form-actions mt-10">
															<div class="row">
																<div class="col-md-6">
																	<div class="row">
																		<div class="col-md-6">
																			<button type="submit" class="btn btn-success  mr-10">Submit</button>
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