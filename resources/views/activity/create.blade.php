@extends('layouts.app')  
@section('content')

<style type="text/css">
	.select2-search__field{
		color: black;
	}
</style>


			<!-- Main Content -->
			<div class="page-wrapper">
				<div class="container-fluid">
					
					<!-- Title -->
					<div class="row heading-bg">
						<div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
							<h5 class="txt-dark">CREATE PLAN</h5>
						</div>
					
						<!-- Breadcrumb -->
						<div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
							{{-- <ol class="breadcrumb">
								<li><a href="index.html">Dashboard</a></li>
								<li><a href="#"><span>form</span></a></li>
								<li class="active"><span>form-layout</span></li>
							</ol> --}}
							<a href="{{URL::to('/dashboard')}}"><button class="btn btn-primary" style="float: right;">BACK</button></a>
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
													<form id="create_activity_form" class="form-horizontal">
														{{csrf_field()}}
														<div class="form-body">
															{{-- <h6 class="txt-dark capitalize-font"><i class="zmdi zmdi-account mr-10"></i>General Info</h6> --}}
															<hr class="light-grey-hr"/>
															<div class="row">
																<div class="col-md-6">
																	<div class="form-group">
																		<label class="control-label col-md-3">Activity Date</label>
																		<div class="col-md-9">
																			<input type="text" class="form-control" name="plan_date" id="plan_date" autocomplete="off">
																			<input type="hidden" name="update" value="false">

																		</div>
																	</div>
																</div>
																<div class="col-md-6">
																	<div class="form-group">
																		<label class="control-label col-md-3">Activity Type</label>
																		<div class="col-md-9">
																			<select class="form-control" id="activity_type" name="activity_type[]" multiple="multiple">
																				<option value="Dealer Training">Dealer Training</option>
																				<option value="Regional Training">Regional Training</option>
																				<option value="RTC Training">RTC Training</option>
																				<option value="Roll Out">Roll Out</option>
																				<option value="Internal Training">Internal Training</option>
																				<option value="KIN New Joining">KIN New Joining</option>
																				<option value="Pre-Roll Out">Pre-Roll Out</option>
																			</select>
																		</div>
																	</div>
																</div>
															</div>
															<div class="row">
																<div class="col-md-6">
																	<div class="form-group">
																		<label class="control-label col-md-3">No. Of Man Days</label>
																		<div class="col-md-9">
																			<input class="form-control" type="number" name="no_of_men_days" id="no_of_men_days">
																		</div>
																	</div>
																</div>
																<div class="col-md-6">
																	<div class="form-group">
																		<label class="control-label col-md-3">Region</label>
																		<div class="col-md-9">
																			<select class="form-control" id="region" name="region[]">
																				<option value="North">North</option>
																				<option value="East">East</option>
																				<option value="West">West</option>
																				<option value="South">South</option>
																				<option value="Globtier Internal Training">Globtier Internal Training</option>
																			</select>
																		</div>
																	</div>
																</div>
															</div>
															<div class="row">
																<div class="col-md-6">
																	<div class="form-group">
																		<label class="control-label col-md-3">Dealer Code</label>
																		<div class="col-md-9">
																			<select class="form-control" id="dealer_code" name="dealer_code[]" multiple="multiple">
																				@foreach($dealers as $dealer)
																				  <option value="{{$dealer->Dealer_code}}">{{ $dealer->Dealer_code }} -- {{ $dealer->Dealership_Name }}</option>
																				@endforeach
																			</select>
																		</div>
																	</div>
																</div>
																<div class="col-md-6">
																	<div class="form-group">
																		<label class="control-label col-md-3">Trainer</label>
																		<div class="col-md-9">
																			<select class="form-control" id="trainer" name="trainer[]" multiple="multiple">
																				@foreach($trainers as $trainer)
																				  <option value="{{$trainer->id}}">{{ $trainer->name }}</option>
																				@endforeach
																			</select>
																		</div>
																	</div>
																</div>
															</div>
															<div class="row">
																<div class="col-md-6">
																	<div class="form-group">
																		<label class="control-label col-md-3">Module</label>
																		<div class="col-md-9">
																			<select class="form-control" name="module[]" id="module" multiple="multiple">
																				<option value="DMS Sales">DMS Sales</option>
																				<option value="DMS Service">DMS Service</option>
																				<option value="My Sales">My Sales</option>
																				<option value="CVISI">CVISI</option>
																				<option value="Warranty">Warranty</option>
																				<option value="CRM">CRM</option>
																				<option value="Driver App">Driver App</option>
																				<option value="BI-Sales">BI-Sales</option>
																				<option value="BI-After Sales">BI-After Sales</option>
																				<option value="BI-Warranty">BI-Warranty</option>
																				<option value="BI-All">BI-All</option>
																				<option value="All">All</option>
																				<option value="Others">Others</option>
																				<option value="KIA CPO">KIA CPO</option>
																			</select>
																		</div>
																	</div>
																</div>
																<div class="col-md-6">
																	<div class="form-group">
																		<label class="control-label col-md-3">Remarks</label>
																		<div class="col-md-9">
																			<textarea class="form-control" name="remarks" id="remarks"></textarea>
																		</div>
																	</div>
																</div>
															</div>
															<div class="row">
																<div class="col-md-6">
																	<div class="form-group">
																		<label class="control-label col-md-3">Training Type</label>
																		<div class="col-md-9">
																			<select class="form-control" name="training_type" id="training_type">
																				<option value="Onsite">Onsite</option>
																				<option value="Online">Online</option>
																			</select>
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

			<div class="modal fade" style="z-index: 1000000000;" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
			  <div class="modal-dialog" role="document">
			    <div class="modal-content">
			      <div class="modal-header">
			        <h5 class="modal-title" id="exampleModalLabel">Add Dealer</h5>
			        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
			          <span aria-hidden="true">&times;</span>
			        </button>
			      </div>
			      <div class="modal-body">
													<form id="add_dealer_form" class="form-horizontal">
														{{csrf_field()}}
														<div class="form-body">
															{{-- <h6 class="txt-dark capitalize-font"><i class="zmdi zmdi-account mr-10"></i>General Info</h6> --}}
															<hr class="light-grey-hr"/>
															<div class="row">
																<div class="col-md-6">
																	<div class="form-group">
																		<label class="control-label col-md-3">Region</label>
																		<div class="col-md-9">
																			<select class="form-control" name="region" id="region">
																				<option value="North">North</option>
																				<option value="South">South</option>
																				<option value="East">East</option>
																				<option value="West">West</option>
																			</select>
																		</div>
																	</div>
																</div>
																<div class="col-md-6">
																	<div class="form-group">
																		<label class="control-label col-md-3">Dealer Code</label>
																		<div class="col-md-9">
																			<input type="text" class="form-control" name="dealer_code_add" id="dealer_code_add">

																		</div>
																	</div>
																</div>
															</div>
															<div class="row">
																<div class="col-md-6">
																	<div class="form-group">
																		<label class="control-label col-md-3">Dealer Name</label>
																		<div class="col-md-9">
																			<input type="text" class="form-control" name="dealer_name" id="dealer_name">

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


@endsection
